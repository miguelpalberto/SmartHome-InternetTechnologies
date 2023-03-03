import requests
from time import strftime,localtime
from msvcrt import kbhit,getch

def datahora(): # devolve a data e hora atuais no seguinte formato: dd-mm-aaaa hh:mm:ss
    hora = strftime("%d-%m-%Y %H:%M:%S", localtime())
    return hora

def send_to_api(u,d):
    r=requests.post(u, data=d) # r.status_code | r.text
    if r.status_code == 200:
        print("OK: POST realizado com sucesso")
        print(r.status_code)
    else:
        print("ERRO: Não foi possivel realizar o pedido")
        print(r.status_code)

url = 'http://127.0.0.1:8080/SmartHome/api/api.php'

try:
    print("Usage:\n[0] Fecha a porta\n[1] Abre a porta\n\n[CTRL+C] Terminar")

    while True: # ciclo para o programa executar sem parar...

        if kbhit() == True:
            tecla = int(getch())
            if tecla == 0:
                dados = {"nome" : "porta", "valor" : tecla, "hora" : datahora()}
                send_to_api(url,dados)
                dados = {"nome" : "/atuadores/fechadura", "valor" : tecla, "hora" : datahora()}
                send_to_api(url,dados)
                print("\nPorta foi fechada")
            elif tecla == 1:
                dados = {"nome" : "porta", "valor" : tecla, "hora" : datahora()}
                send_to_api(url,dados)
                dados = {"nome" : "/atuadores/fechadura", "valor" : tecla, "hora" : datahora()}
                send_to_api(url,dados)
                print("\nPorta foi aberta")    
            else:    
                print("\nOpção inválida")
            

except KeyboardInterrupt: # caso haja interrupção de teclado CTRL+C
    print("Programa terminado pelo utilizador\n")

except: # caso haja um erro qualquer
    print("Ocorreu um erro: \n", sys.exc_info())

finally: # executa sempre, independentemente se ocorreu exception
    print("Fim do programa\n")