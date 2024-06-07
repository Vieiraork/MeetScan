import requests
import json


class RestController:
    def __init__(self) -> None:
        pass

    def get_all_faces(self):
        res = None

        try:
            res = requests.get('http://meetscan.desenvolvimento.com.br/api/anexos/search')
        except Exception as e:
            print('Algo deu errado')

        return res.json()
    
    def open_door(self):
        res = None

        try:
            res = requests.get('http://192.168.100.2:1222')
        except Exception as e:
            print('Não foi possível chegar no endereço')
        
        return res.status_code
