// Final code for IRSesor with LED intensity
// Code for the Smart Street Light 

int IRSensor = 9;
int LED = 11;

void setup() {
  pinMode(LED, OUTPUT);
  pinMode(IRSensor, INPUT);
  Serial.begin(9600);
  Serial.println("Serial is Working......");
}

void loop() {
  // Checks the status of the sensor
  int statusSensor = digitalRead(IRSensor);
  Serial.println(statusSensor);

// Main If-Else Loop for the IRSensor 
  if (statusSensor == 1) {
    // analogWrite(LED, 50);
    digitalWrite(LED, HIGH);
    Serial.println("Where are you  ???????");
  }

  else if (statusSensor == 0) {
    // for (int ledval = 0; ledval <= 255; ledval += 250) {
      digitalWrite(LED, LOW);
      // Serial.println(ledval);
      Serial.println("Haha, I got you! ");
    // }
  }
  delay(100);
}