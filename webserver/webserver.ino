#include <Arduino.h>
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include <MFRC522.h>
#include <SPI.h>

const char* rede      = "";
const char* senha     = "";
const uint8_t RST_PIN = D3;
const uint8_t SS_PIN  = D4; 

ESP8266WiFiMulti WiFiMulti;
MFRC522 rfid(SS_PIN, RST_PIN);
MFRC522::MIFARE_Key key;

String tag;

void setup() {
  int loadDot = 0;
  Serial.begin(115200);
  SPI.begin();
  rfid.PCD_Init();

  // Serial.setDebugOutput(true);

  Serial.println();
  Serial.println();
  Serial.println();

  for (uint8_t t = 4; t > 0; t--) {
    Serial.printf("[SETUP] WAIT %d...\n", t);
    Serial.flush();
    delay(1000);
  }
  
  WiFi.mode(WIFI_STA);
  WiFi.begin(rede, senha);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
    
    loadDot++;
  }
  Serial.print("");
  Serial.print("Ip local: ");
  Serial.println(WiFi.localIP());
}

void loop() {
    WiFiClient client;

    HTTPClient http;
    if (!rfid.PICC_IsNewCardPresent())
      return;
    
    if (rfid.PICC_ReadCardSerial()) {
      for (byte i = 0; i < 4; i++) {
        tag += rfid.uid.uidByte[i];
      }
    }

    if (tag != "") {
      if (http.begin(client, "http://192.168.100.7/meetscan-app/public/api/codigos/" + tag)) {
        int code = http.GET();
        String res = http.getString();

        if (code > 0) {
          Serial.print("Http code: ");
          Serial.println(code);
          Serial.print("Response: ");
          Serial.println(res);
        } else {
          Serial.print("Error: ");
          Serial.println(res);
        }

        Serial.println(tag);
        tag = "";
        rfid.PICC_HaltA();
        rfid.PCD_StopCrypto1();
      }
    }

    delay(5000);
}
