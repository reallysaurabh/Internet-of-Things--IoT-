#include <SPI.h>
#include <Ethernet.h>

byte mac[] = {
  0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED
};
IPAddress ip(10, 36, 2, 234);
EthernetServer server(80);

int pin8=8;
int sensor=A0;
int sensorValue=0;
void setup() {
  
  pinMode(pin8, OUTPUT);
  Serial.begin(9600);
  Ethernet.begin(mac, ip);
  server.begin();
}

void loop() {
  sensorValue=analogRead(sensor);
  Serial.println(sensorValue,DEC);
  if(sensorValue>1000){
    digitalWrite(pin8, HIGH);
  }
  else{
    digitalWrite(pin8, LOW);  
  }
  EthernetClient client = server.available();
  
  if (client) {
    Serial.println("new client");
    
    boolean currentLineIsBlank = true;
    while (client.connected()) {
      if (client.available()) {
        char c = client.read();
        Serial.write(c);
        
        if (c == '\n' && currentLineIsBlank) {
          client.println("HTTP/1.1 200 OK");
          client.println("Content-Type: text/html");
          client.println("Connection: close");  
          client.println();
          client.println("<!DOCTYPE HTML>");
          client.println("<html>");
          
          client.println("<script>");
          client.println("var x=");
          client.println(sensorValue);
          client.println(";");
          client.println("typeof(x);");
          client.println("console.log(x);");
          client.println("document.write('upvalue')");
          client.println("document.write(x);");
          client.println("document.write('down value')");
          client.println("window.location.href='http://webintern.comuv.com/GasOleak.php?w1='+x;");
          client.println("</script>");
          
          
          client.println("</html>");
          break;
        }
        if (c == '\n') {
          currentLineIsBlank = true;
        }
        else if (c != '\r') {
          currentLineIsBlank = false;
        }
      }
    }
    delay(1);
    client.stop();
    Serial.println("client disconnected");
  }
  
  
  
  
}
