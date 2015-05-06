# Internet-of-Things--IoT-
Projects based on Internet of Things using different sensors and arduino uno 

Basically, the communication through sensors is a sensor-arduino, arduino-sensor type.
But if you introduce the term "Internet of things" to it, the same process becomes the
communication of
      "arduino-sensor-server-user, user-server-arduino-sensor"

MedAlert-
An electronic device that reminds you to take your medicine of the day, if you forget.
<Further Description Pending>

GasOleak-
An electronic device that uses MQ-135 sensor to detect gases around it.
This sensor returns  a value to arduino and to the server. The threshold value is 1000. Whenever, it is reached
the safety limit for gas is crossed and the sensor informs the server and the information passes from server to 
the users. 
MQ-135 are used in air quality control equipments for buildings/offices, are suitable for detecting
of NH3,NOx, alcohol, Benzene, smoke,CO2 ,etc.
