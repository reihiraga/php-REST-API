#include <Arduino.h>
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>
#define USE_SERIAL Serial
ESP8266WiFiMulti WiFiMulti;
#include <SoftwareSerial.h>
#include <OneWire.h>
#include <DallasTemperature.h> 
#include <WiFiClient.h>
#define ONE_WIRE_BUS 4
OneWire oneWire(ONE_WIRE_BUS); 
DallasTemperature sensors(&oneWire);
WiFiClient wifiClient;

int getSensor(){    
  int Celcius=0;  
  sensors.requestTemperatures();   
  Celcius=sensors.getTempCByIndex(0);   
  Serial.print(" C  ");  
  Serial.print(Celcius);  
  return Celcius;
}

void sendToServer(int mytemp){  
  if((WiFiMulti.run() == WL_CONNECTED)) {    
    String temper=(String)mytemp;
    String apiGetData = "http://192.168.1.6/IO/input.php?temp="+temper; //change 192.168.1.6 with your IP 
    HTTPClient http;
    http.begin(wifiClient, apiGetData);   
    USE_SERIAL.print("[HTTP] GET...\n");    
    //start connection and send HTTP header   
    int httpCode = http.GET();    
    delay(1000);    
    if(httpCode > 0) {      
      // HTTP header has been send and Server response header has been handled         
      USE_SERIAL.printf("[HTTP] GET... code: %d\n", httpCode);            
      if(httpCode == HTTP_CODE_OK) {        
        String payload = http.getString();        
        USE_SERIAL.println(payload);        
        USE_SERIAL.write("Sent");        
        delay(3000);           
        USE_SERIAL.write("AT+CIPCLOSE\r\n");      
      }    
    }  
  }
}

void setup() {  
  delay(500); // Let the module self-initialize   
  USE_SERIAL.write("AT+CWQAP");  
  USE_SERIAL.begin(9600);    
  for(uint8_t t = 4; t > 0; t--) {    
    USE_SERIAL.printf("[SETUP] WAIT %d...\n", t);    
    USE_SERIAL.flush();    
    delay(1000);  
  }  
  WiFiMulti.addAP("admin", "admin123");// Set Your (ID, Password) WiFi here
}

void loop() {
  sendToServer(getSensor()); 
}
