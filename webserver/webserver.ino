#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>
#include <MFRC522.h>


const char* rede        = "";
const char* senha       = "";
const uint8_t RESET_PIN = D3;
const uint8_t SS_PIN    = D4;

IPAddress ip(192, 168, 100, 2);
IPAddress gateway(192, 168, 100, 1);
IPAddress subnet(255, 255, 255, 0);
IPAddress dns(192, 168, 100, 1);

MFRC522 rfid(SS_PIN, RESET_PIN);
MRFC522::MIFARE_Key key;

String tag;

ESP8266WebServer server(8000);
int contador = 0;

void enviaResposta() {
  server.send(200, "text/plain", "hello from ESP8266");
}

void imprimeMensagemConexao() {
  if (contador == 0){
    Serial.println("Conectando no WIFI.");
    Serial.flush(); 
  }
  else if (contador == 1){
    Serial.println("Conectando no WIFI..");
    Serial.flush();
  }
  else if (contador == 2){
    Serial.println("Conectando no WIFI...");
    Serial.flush();
  }

  contador++;
  if (contador == 3) {
    contador=0;
  }
}

void capturaParametro() {
  String paramNome = server.arg(0);

  String mensagem = "Parâmetro: " + paramNome;
  server.send(200, "text/plain", mensagem);
}

void setup() {
  Serial.begin(115200);

  WiFi.config(ip, gateway, subnet, dns);
  WiFi.begin(rede, senha);

  while(WiFi.status() != WL_CONNECTED) {
    delay(1000);
    imprimeMensagemConexao();
  }

  SPI.begin();
  rfid.PCD_Init();

  Serial.println(WiFi.localIP());

  server.on("/", enviaResposta);
  server.on("/param", capturaParametro);
  server.begin();
  Serial.println("Servidor HTTP foi iniciado.");
}

void sendTagForServer(String tag) {
  // TODO - IMPLEMENTAR A CHAMADA DO SERVIDOR
}

void loop() {
  server.handleClient();

  if (!rfid.PICC_IsNewCardPresent())
    return;
  if (rfid.PICC_ReadCardSerial()) {
    for (byte i=0; i < 4; i++) {
      tag += rfid.uid.uidByte[i];
    }
    // Chamar servidor laravel
    Serial.println(tag);
    sendTagForServer(tag);
    tag = "";
    rfid.PICC_HaltA();
    rfid.PCD_StopCrypto1();
  }
  }
}
