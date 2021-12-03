#include <Arduino.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

const char* ssid = "vivo 2019";
const char* pass = "12345678an";

int led = D4;
String server = "http://192.168.43.197:8080/?nik=3211027103980002";
int requestHTTPGetCode(String server);

void setup() {
  // put your setup code here, to run once:
  Serial.begin(115200);
  pinMode(led, OUTPUT);
  digitalWrite(led, LOW);
  delay(1000);

  WiFi.begin(ssid, pass);
  // wait for connection
  while(WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  
  // if wifi connected
  Serial.print(".");
  Serial.print("Connected to ");
  Serial.println(ssid);
  Serial.print("IP ADDRESS: ");
  Serial.println(WiFi.localIP());

  int response = requestHTTPGetCode(server);
  Serial.print("Status Code : ");
  Serial.println(response);

  if(response == 200) {
    digitalWrite(led, HIGH);
    delay(2000);
    digitalWrite(led, LOW);
  }
}

void loop() {
  if(WiFi.status() == WL_CONNECTED) {
    int requestStatus = requestHTTPGetCode(server);
    Serial.print("Status Code : ");
    Serial.println(requestStatus);
    delay(2000);
  }
}

int requestHTTPGetCode(String server) {
  HTTPClient http;
  WiFiClient wifiClient;
  // Domain name with URL path or IP address with path
  http.begin(wifiClient, server);
  // Send HTTP GET request
  int httpResponseCode = http.GET();
  // Free resources
  http.end();

  return httpResponseCode;
}