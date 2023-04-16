const int BUTTON_PIN = 7; // Arduino pin connected to button's pin
const int BUZZER_PIN = 3; // Arduino pin connected to Buzzer's pin
 
void setup() {
  Serial.begin(9600);                // initialize serial
  pinMode(BUTTON_PIN, INPUT_PULLUP); // set arduino pin to input pull-up mode
  pinMode(BUZZER_PIN, OUTPUT);       // set arduino pin to output mode
}
 
void loop() {
  int buttonState = digitalRead(BUTTON_PIN); // read new state
 
  if (buttonState == LOW) {
    Serial.println("The button is being pressed");
    digitalWrite(BUZZER_PIN, LOW); // turn on
  }
  else
  if (buttonState == HIGH) {
    Serial.println("The button is unpressed");
    digitalWrite(BUZZER_PIN, HIGH);  // turn off
  }
}