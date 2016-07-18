#include <SPI.h>
#include <Ethernet.h>

int inPin = 7;  
int val=0;
String id="12345";


byte mac[] = {
  0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED
};
IPAddress ip(10,36, 2, 145);


EthernetServer server(80);

void setup() {
  Serial.begin(9600);
  pinMode(inPin, INPUT);      

  while (!Serial) {
  }
  Ethernet.begin(mac, ip);
  server.begin();
  Serial.print("server is at ");
  Serial.println(Ethernet.localIP());
}


void loop() {
  
  val = digitalRead(inPin);
  Serial.println(val);
  EthernetClient client = server.available();
  if (client) {
    Serial.println("new client");
    boolean currentLineIsBlank = true;
    while (client.connected()) {
      if (client.available()) {
        char c = client.read();
        Serial.write(c);
        // if you've gotten to the end of the line (received a newline
        // character) and the line is blank, the http request has ended,
        // so you can send a reply
        if (c == '\n' && currentLineIsBlank) {
          // send a standard http response header
          client.println("HTTP/1.1 200 OK");
          client.println("Content-Type: text/html");
          client.println("Connection: close");  // the connection will be closed after completion of the response
          client.println("Refresh: 1");  // refresh the page automatically every 5 sec
          client.println();
          client.println("<!DOCTYPE HTML>");
          client.println("<html>");
          
          client.println("<script>");
          client.println("var x=");
          client.println(val);
          client.println(";");
          client.println("var id=");
          client.println(id);
          client.println(";");
          client.println("document.write(x);");
          client.println("document.write(id);");
          client.println("window.location.href='http://127.0.0.1/TPDDL/add.php?val='+x+'&id='+id;");
          client.println("</script>");
          client.println("</html>");
          break;
        }
        if (c == '\n') {
          // you're starting a new line
          currentLineIsBlank = true;
        }
        else if (c != '\r') {
          // you've gotten a character on the current line
          currentLineIsBlank = false;
        }
      }
    }
    // give the web browser time to receive the data
    delay(5);
    // close the connection:
    client.stop();
    Serial.println("client disconnected");
  }
}

