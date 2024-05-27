from face_with_cv2 import FaceRecognition
from rest_controller import RestController

if __name__ == '__main__':
    # rest = RestController()
    # print(rest.get_all_faces())
    face = FaceRecognition()
    face.run_recognition()