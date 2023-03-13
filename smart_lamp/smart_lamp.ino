#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>
#include <IRremote.h>

#define transmitter_led 4

const char* ssid = "hotspot";
const char* password = "hotspot12";

String token = "av3KwOVR6eUvrO86Y5aSPb3ye";
String serverName = "https://platform.penelitianrpla.com";

unsigned long lastTime = 0;
unsigned long timerDelay = 1000;

String projectName = "Lingian";
String devices = "smart_lamp"; 

bool V0 = false;
bool V1 = false;
bool V2 = false;
bool V3 = false;
bool V4 = false;
bool V5 = false;
bool V17 = false;
bool V18 = false;
bool V22 = false;
bool V11 = false;
bool V10 = false;
bool V8 = false;
bool V9 = false;

void setup() {
  Serial.begin(115200);

  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());

  IrSender.begin(transmitter_led);
  pinMode(4, OUTPUT);
}

void loop() {
  //Send an HTTP POST request every 10 minutes
  if ((millis() - lastTime) > timerDelay) {
    //Check WiFi connection status
    if (WiFi.status() == WL_CONNECTED) {
      HTTPClient http;

      String serverPath = serverName + "/lastData/" + projectName + "/" + devices;

      // Your Domain name with URL path or IP address with path
      http.begin(serverPath.c_str());
      http.addHeader("token", token);
      int httpResponseCode = http.GET();

      if (httpResponseCode > 0) {
        String payload = http.getString();
        StaticJsonDocument<1000> doc;
        DeserializationError error = deserializeJson(doc, payload);
        if (error) {
          Serial.print(F("deserializeJson() failed: "));
          Serial.println(error.f_str());
          return;
        }
        Serial.print("payload : ");
        Serial.println(payload);
        if (doc["data"]["V0"] == "1" || doc["data"]["V0"] == 1) {
          if(!V0){
            IrSender.sendNEC(0xEF00, 0x03, true, 0);  //on 1
          }
        }
        if (doc["data"]["V1"] == "1" || doc["data"]["V1"] == 1) {
          IrSender.sendNEC(0xEF00, 0x02, true, 0);  //off 1
        }
        if (doc["data"]["V2"] == "1" || doc["data"]["V2"] == 1) {
          IrSender.sendNEC(0xEF00, 0x00, true, 0);  //terang 1
        }
        if (doc["data"]["V3"] == "1" || doc["data"]["V3"] == 1) {
          IrSender.sendNEC(0xEF00, 0x01, true, 0);  //redup 1
        }
        if (
          doc["data"]["V8"] == "1" || doc["data"]["V8"] == 1 || doc["data"]["V9"] == "1" || doc["data"]["V9"] == 1 || doc["data"]["V10"] == "1" || doc["data"]["V10"] == 1 || doc["data"]["V11"] == "1" || doc["data"]["V11"] == 1) {
          if (doc["data"]["V8"] == "1" || doc["data"]["V8"] == 1) {
            IrSender.sendNEC(0xEF00, 0x0B, true, 0);  //FADE
          }
          if (doc["data"]["V9"] == "1" || doc["data"]["V9"] == 1) {
            IrSender.sendNEC(0xEF00, 0x0F, true, 0);  //STROBE
          }
          if (doc["data"]["V10"] == "1" || doc["data"]["V10"] == 1) {
            IrSender.sendNEC(0xEF00, 0x13, true, 0);  //SMOTH
          }
          if (doc["data"]["V11"] == "1" || doc["data"]["V11"] == 1) {
            IrSender.sendNEC(0xEF00, 0x17, true, 0);  //FLASH
          }
          return;
        }
        if (doc["data"]["V4"] == "1" || doc["data"]["V4"] == 1) {
          IrSender.sendNEC(0xEF00, 0x4, true, 0);  //merah 1
        }
        if (doc["data"]["V5"] == "1" || doc["data"]["V5"] == 1) {
          IrSender.sendNEC(0xEF00, 0x5, true, 0);  //hijau 1
        }
        if (doc["data"]["V6"] == "1" || doc["data"]["V6"] == 1) {
          IrSender.sendNEC(0xEF00, 0x06, true, 0);  //biru 1
        }
        if (doc["data"]["V7"] == "1" || doc["data"]["V7"] == 1) {
          IrSender.sendNEC(0xEF00, 0x07, true, 0);  //putih 1
        }
        if (doc["data"]["V12"] == "1" || doc["data"]["V12"] == 1) {
          IrSender.sendNEC(0xEF00, 0x08, true, 0);  //merahmuda
        }
        if (doc["data"]["V12"] == "1" || doc["data"]["V12"] == 1) {
          IrSender.sendNEC(0xEF00, 0x08, true, 0);  //merahmuda
        }
        if (doc["data"]["V13"] == "1" || doc["data"]["V13"] == 1) {
          IrSender.sendNEC(0xEF00, 0x09, true, 0);  //hijaumuda
        }
        if (doc["data"]["V14"] == "1" || doc["data"]["V14"] == 1) {
          IrSender.sendNEC(0xEF00, 0x0A, true, 0);  //birumuda
        }
        if (doc["data"]["V15"] == "1" || doc["data"]["V15"] == 1) {
          IrSender.sendNEC(0xEF00, 0x0C, true, 0);  //orange
        }
        if (doc["data"]["V16"] == "1" || doc["data"]["V16"] == 1) {
          IrSender.sendNEC(0xEF00, 0x0D, true, 0);  //birulangit
        }
        if (doc["data"]["V17"] == "1" || doc["data"]["V17"] == 1) {
          IrSender.sendNEC(0xEF00, 0x0E, true, 0);  //ungu 1
        }
        if (doc["data"]["V18"] == "1" || doc["data"]["V18"] == 1) {
          IrSender.sendNEC(0xEF00, 0x10, true, 0);  //KUNING 1
        }
        if (doc["data"]["V19"] == "1" || doc["data"]["V19"] == 1) {
          IrSender.sendNEC(0xEF00, 0x11, true, 0);  //HIJAUKEBIRUAN
        }
        if (doc["data"]["V20"] == "1" || doc["data"]["V20"] == 1) {
          IrSender.sendNEC(0xEF00, 0x11, true, 0);  //HIJAUKEBIRUAN
        }
        if (doc["data"]["V21"] == "1" || doc["data"]["V21"] == 1) {
          IrSender.sendNEC(0xEF00, 0x14, true, 0);  //KUNINGMUDA
        }
        if (doc["data"]["V22"] == "1" || doc["data"]["V22"] == 1) {
          IrSender.sendNEC(0xEF00, 0x15, true, 0);  //DARKBLUEGREEAN
        }
        if (doc["data"]["V23"] == "1" || doc["data"]["V23"] == 1) {
          IrSender.sendNEC(0xEF00, 0x16, true, 0);  //PINK
        }
      }
      // Free resources
      http.end();
    } else {
      Serial.println("WiFi Disconnected");
    }
    lastTime = millis();
  }
}