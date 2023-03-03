#Codigo python para tirar fotografia com a webcam e envia-la para a dashboard
from time import strftime,localtime
import time
import cv2 as cv
import requests
import winsound

url_upload = 'http://127.0.0.1:8080/SmartHome/upload.php'
url_post = 'http://127.0.0.1:8080/SmartHome/api/api.php'
url_camara = 'http://127.0.0.1:8080/SmartHome/api/api.php?nome=camara'


def datahora(): # devolve a data e hora atuais no seguinte formato: dd-mm-aaaa hh:mm:ss
    hora = strftime("%d-%m-%Y %H:%M:%S", localtime())
    return hora

def send_to_api(u,d):
    r=requests.post(u, data=d) # r.status_code | r.text
    if r.status_code == 200:
        print("OK (valor camara): POST realizado com sucesso")
        print("Status code: " + str(r.status_code))
    else:
        print("ERRO (valor camara): Não foi possivel realizar o pedido")
        print("Status code: " + str(r.status_code))

def send_file():
    r=requests.post(url_upload, files={'imagem': open('camara.png', 'rb')}) # r.status_code | r.text
    if r.status_code == 200:
        print("OK (envio da foto): POST realizado com sucesso")
        print("Status code: " + str(r.status_code))
    else:
        print("ERRO (envio da foto): Não foi possivel realizar o pedido")
        print("Status code: " + str(r.status_code))

try:
    print("\nPrima CTRL+C para terminar\n")

    while True: # ciclo para o programa executar sem parar...
        print("\n*** LER camara ***")
        r=requests.get(url_camara) # r.status_code | r.text
        time.sleep(2)

        if r.status_code == 200:
            print("OK: GET realizado com sucesso...")
            print("Status code: " + str(r.status_code))
            
            if float(r.text) == 1:
                print("\nCamara ativada!")
                print("Vai ser enviada uma imagem para o dashboard...\n")
                winsound.PlaySound("Alarm.wav", winsound.SND_FILENAME)
                time.sleep(2)
        
                # captura de imagem
                camera = cv.VideoCapture(0, cv.CAP_DSHOW)
                ret, image = camera.read()
                print ("Resultado da Camera = " + str(ret))
                cv.imwrite('camara.png', image)
                camera.release()
                cv.destroyAllWindows()
                cv.waitKey(5000)

                send_file() # envia imagem da camara para upload.php
                dados_post = {"nome" : "camara", "valor" : '0', "hora" : datahora()}
                send_to_api(url_post,dados_post) # volta a colocar o estado da camara para 0
            else:
                print("Camara não ativa!\n")
                time.sleep(2)
                
        else:
            print("ERRO: Não foi possivel realizar o pedido GET")
            print("Status code: " + str(r.status_code))

except KeyboardInterrupt: # caso haja interrupção de teclado CTRL+C
    print("Programa TERMINADO pelo utilizador!")

except: # caso haja um erro qualquer
    print("Ocorreu um ERRO:", sys.exc_info())

finally: # executa sempre, independentemente se ocorreu exception
    print("Fim do programa!")