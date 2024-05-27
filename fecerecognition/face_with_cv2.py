import face_recognition
import cv2
from time import sleep
import os, sys
import numpy as np
import math
import threading
from rest_controller import RestController


class FaceRecognition:
    face_locations        = []
    face_encodings        = []
    face_names            = []
    known_face_encodings  = []
    known_face_names      = []
    process_current_frame = True
    all_faces_from_rest   = []


    def __init__(self) -> None:
        self.__rest = RestController()
        self.all_faces_from_rest = self.__rest.get_all_faces()
        self.__encode_faces()
    

    def __encode_faces(self):
        for image in self.all_faces_from_rest:
            face_image = face_recognition.load_image_file(image['ds_caminho'])
            face_encoding = face_recognition.face_encodings(face_image)[0]

            self.known_face_encodings.append(face_encoding)
            self.known_face_names.append(image)

        print(self.known_face_names)
    

    def __change_process_current_frame(self):
        self.process_current_frame = not self.process_current_frame


    def __recognite_faces(self, rgb_small_frame):
        self.face_locations = face_recognition.face_locations(rgb_small_frame)
        self.face_encodings = face_recognition.face_encodings(rgb_small_frame, self.face_locations)
        print(f'Faces {len(self.face_locations)}')

        if len(self.face_locations) > 0:
            for face_encoding in self.face_encodings:
                matches    = face_recognition.compare_faces(self.known_face_encodings, face_encoding)

                face_distances   = face_recognition.face_distance(self.known_face_encodings, face_encoding)
                best_match_index = int(face_distances)
                print('Face reconhecida com sucesso' if best_match_index == 0 else 'Face não foi reconhecida')

                if matches[best_match_index]:
                    self.__rest.open_door()
                    # name       = self.known_face_names[best_match_index]
                    # confidence = face_confidence(face_distances[best_match_index])
                    # print(matches[best_match_index])
                    # print(matches[best_match_index])
            
        sleep(2)
        self.__change_process_current_frame()


    def run_recognition(self):
        video_capture = cv2.VideoCapture(0)

        if not video_capture.isOpened():
            sys.exit('Câmera não foi encontrada')

        while True:
            ret, frame = video_capture.read()

            if self.process_current_frame:
                self.__change_process_current_frame()

                small_frame = cv2.resize(frame, (0, 0), fx=0.25, fy=0.25)
                rgb_small_frame = small_frame[:, :, ::-1]

                try:
                    t1 = threading.Thread(target=self.__recognite_faces, args=(rgb_small_frame.copy(),))
                    t1.start()
                except:
                    print('Não foi possível realizar o reconhecimento facial')
            
            cv2.imshow('Reconhecimento facial', frame)

            if cv2.waitKey(1) == ord('q'):
                break
        
        video_capture.release()
        cv2.destroyAllWindows()
