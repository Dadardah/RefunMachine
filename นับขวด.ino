#include <ESP8266WiFi.h>
#include <WiFiClientSecure.h>
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>


char ssid[] = "Ok__2G";         //ใส่ชื่อ Wifi
char password[] = "Elf@N@ttaph0n"; //ใส่รหัส Wifi

WiFiClientSecure client; 
WiFiClient wifiClient;
HTTPClient http;   

#define HOST "http://192.168.200.33/scanbarcode/service.php?trigger=machine_refun" //https://refunmachine.appspot.com/service.php?trigger=machine_refun ชื่อ domain ของเรา xxxxxx.com/service.php?trigger=machine_refun"
//#define HOST_FINGERPRINT "08 84 96 E7 A1 31 5C 0B 27 22 1C AB 13 CB 52 89 38 CA D0 1B" //ท่าเป็น https ต้องใช้ SHA-1 Fingerprint หาได้จากในหน้าเว็ป

void setup() {
  Serial.begin(115200);

  // Connect to the WiFI
  WiFi.mode(WIFI_STA);
  WiFi.disconnect();
  delay(100);

  // Attempt to connect to Wifi network:
  Serial.print("Connecting Wifi: ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED)
  {
    Serial.print(".");
    delay(500);
  }
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  IPAddress ip = WiFi.localIP();
  Serial.println(ip);
  //client.setFingerprint(HOST_FINGERPRINT); //เว็ปที่เป็น https ต้องใช้
}

void loop() {
   int cm = Ultrasonic(D1,D2);    
    if (cm <10) {                 //หากน้อยกว่า 10cm นับขวด
      call_web(); 
    }
}

int Ultrasonic(byte trigPin,byte echoPin) {  // function สำหรับรับค่าเซ็นเซอร์
  pinMode(trigPin, OUTPUT);
  pinMode(echoPin, INPUT);
  long duration, distance;
  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);
  duration = pulseIn(echoPin, HIGH);
  distance = duration / 58.2;
  return distance;
}


void call_web(){ // function สำหรับส่งข้อมูลไป web
    http.begin(wifiClient, HOST); //เว็ป http
    //http.begin(client, HOST); // เว็ป https 
    String payload;
    if (http.GET() == HTTP_CODE_OK) 
    {   
        payload = http.getString();
    }
    http.end();
}
