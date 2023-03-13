#include "Platform.h"
#include <ArduinoJson.h>

String token = "ptiZNNdIPfgjMqtQziTXN6cbF";
String server = "http://192.168.137.1:8000";

String ssid = "OPPO A12";
String password = "1234duakali";

unsigned long lastTime = 0;
unsigned long interval = 1000;

bool IN1Status = LOW;
bool IN2Status = LOW;

uint8_t IN1 = D1;
uint8_t IN2 = D2;
int ENA = D5;
int Ir = D7;
int Relay = D0;


String projectName = "rumahan";
String devices = "testing";

Platform platform(token, server);

void setup() {
  // put your setup code here, to run once:
  Serial.begin(115200);
  platform.connectWiFi(ssid, password);
}

void loop() {
  // put your main code here, to run repeatedly:
  int IRStatus = digitalRead(Ir);
  
  if ((millis() - lastTime) > interval) {
    platform.get(projectName, devices);
    String data = platform.getData();
    StaticJsonDocument<200> doc;
    DeserializationError error = deserializeJson(doc, data);
    if (error) {
      Serial.println("error");
      Serial.println(data);
      return;
    }
    
    if(doc["data"]["IN"] == "1" || doc["data"]["IN"] == 1){
      IN1Status = HIGH;
    }else {
      IN1Status = LOW;
    }

    if (IN1Status == 1 && IRStatus == HIGH) {
      digitalWrite(ENA, 250);
      digitalWrite(IN1, LOW);
      digitalWrite(IN2, HIGH);
      digitalWrite(Relay, HIGH);
    } else {
      digitalWrite(Relay, LOW);
      digitalWrite(IN1, LOW);
      digitalWrite(IN2, LOW);
    }
  }
}
