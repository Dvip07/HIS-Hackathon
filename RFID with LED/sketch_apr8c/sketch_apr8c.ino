#include <MFRC522.h>

#define RST_PIN   9
#define SS_PIN    10
#define LED    3

MFRC522 mfrc522(SS_PIN, RST_PIN);   // Create MFRC522 instance

void setup() {
  pinMode(LED, OUTPUT);    // Set the LED pin as an output
  Serial.begin(9600);              // Initialize serial communication
  Serial.println("Serial Begin: "); // Communicating the confirmation of the serial begin
  SPI.begin();                     // Initialize SPI bus
  mfrc522.PCD_Init();              // Initialize MFRC522 RFID reader
}

void loop() {
  // Look for new RFID card
  if (mfrc522.PICC_IsNewCardPresent() && mfrc522.PICC_ReadCardSerial()) {
    Serial.println("RFID card detected!");
    digitalWrite(LED, HIGH);   // Turn on the LED
    delay(1000);                       // Wait for 1 second
    digitalWrite(LED, LOW);    // Turn off the LED
    mfrc522.PICC_HaltA();              // Stop reading the current card
    mfrc522.PCD_StopCrypto1();         // Stop encryption on the card
  }
}
