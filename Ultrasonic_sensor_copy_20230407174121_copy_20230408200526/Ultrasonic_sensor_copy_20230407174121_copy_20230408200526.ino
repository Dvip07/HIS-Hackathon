#define echoPin 10 // attach pin D2 Arduino to pin Echo of HC-SR04
#define trigPin 9 //attach pin D3 Arduino to pin Trig of HC-SR04

// defines variables
float distance1, speed;
unsigned long time1;

long duration; // variable for the duration of sound wave travel
int distance; // variable for the distance measurement
int LED1 = 11;
int LED2 = 3;

void setup() {
  pinMode(trigPin, OUTPUT); // Sets the trigPin as an OUTPUT
  pinMode(echoPin, INPUT); // Sets the echoPin as an INPUT
  Serial.begin(9600); // // Serial Communication is starting with 9600 of baudrate speed
  Serial.println("Ultrasonic Sensor HC-SR04 Test"); // print some text in Serial Monitor
  Serial.println("with Arduino UNO R3");
  pinMode(LED1, OUTPUT);
  pinMode(LED2, OUTPUT);
}
void loop() {
  // Clears the trigPin condition
  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);
  // Sets the trigPin HIGH (ACTIVE) for 10 microseconds
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);

  // time
  time1 = pulseIn(echoPin, HIGH);
  
  // Reads the echoPin, returns the sound wave travel time in microseconds
  // duration = pulseIn(echoPin, HIGH);
  // Calculating the distance
  // distance = duration * 0.034 / 2; // Speed of sound wave divided by 2 (go and back)
  // Displays the distance on the Serial Monitor
  distance = duration/58.2;

  // distance1 = time1 * 0.034 / 2;

{
  if (distance <= 30) {
      analogWrite(LED1, 255);
      analogWrite(LED2, 255);
      // delay(500);
  }
  else if (distance >= 30) {
    analogWrite(LED1, 50);
    analogWrite(LED2, 50);
  }
  delay(1000);
}

  Serial.print("Distance: ");
  Serial.print(distance);
  Serial.println("cm");


  // speed = abs(distance1 / time1);
  // Serial.print("Speed: ");
  // Serial.print(speed);
  // Serial.println(" m/s");

}