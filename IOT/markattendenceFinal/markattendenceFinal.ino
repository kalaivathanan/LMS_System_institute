#include "FS.h"
#include <SPI.h>
#include <TFT_eSPI.h> // Hardware-specific library
#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>  // Make sure to install the ArduinoJson library
#define TRIGGER_PIN 0//5
#include <WiFiUdp.h>
#include <MFRC522.h>
#define RST_PIN         22           // Configurable, see typical pin layout above
#define SS_PIN          5          // Configurable, see typical pin layout above

MFRC522 mfrc522(SS_PIN, RST_PIN);
const char* ssid = "ccccc";
const char* password = "abc@1234";
const String serverUrl = "http://isiwara.devmuthu.lk";//"http://192.168.9.145:8000";//
#define MINPRESSURE 10
#define MAXPRESSURE 40000
#define buzzpin 21
int windowtype = 0;
bool WiFiState = false;

unsigned long delaytime;
uint32_t devID = 0;
const long utcOffsetInSeconds = 19800; // Replace with your UTC offset (in seconds) - 19800 for Indian Standard Time
WiFiUDP ntpUDP;
unsigned long lastTimeUpdate = 0;
const unsigned long timeUpdateInterval =  1000; // Update time every 60 seconds
const int wifiStrengthUpdateInterval = 5000; // Update WiFi strength every 5 seconds
unsigned long lastWifiStrengthUpdate = 0;
unsigned long lastAlive = 0;
char currentTime[20];
String username;
String userid;
unsigned long fetchrecode = 0;
int displayWidth ;
int displayHeight ;
TFT_eSPI tft = TFT_eSPI();
void setup() {
  Serial.begin(115200);
  SPI.begin();                                                  // Init SPI bus
  //  mfrc522.PCD_Init();                                              // Init MFRC522 card
  Serial.println(F("Read personal data on a MIFARE PICC:"));
  //  pinMode(TRIGGER_PIN, INPUT_PULLUP);
  //  pinMode(buzzpin, OUTPUT);
  //  digitalWrite(buzzpin, HIGH);
  //  delay(200);
  //  digitalWrite(buzzpin, LOW);
  Serial.setDebugOutput(false);
  // Connect to Wi-Fi
  WiFi.begin(ssid, password);
  for (int i = 0; i < 17; i = i + 8) {
    devID |= ((ESP.getEfuseMac() >> (40 - i)) & 0xff) << i;
  }
  tft.init();
  tft.setRotation(1);
  tft.fillRect(0, 0, tft.width(), tft.height(), TFT_BLACK);
  tft.setTextColor(TFT_YELLOW);
  tft.setTextSize(3);
  tft.setCursor(60, 100);
  tft.print("Loading");
  unsigned long startAttemptTime = millis();
  pinMode(buzzpin, OUTPUT);

  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
    tft.print(".");
    // checkButton();
  }
  Serial.println("Connected to WiFi.");
  //  digitalWrite(buzzpin, HIGH);
  //  delay(200);
  //  digitalWrite(buzzpin, LOW);
  WiFiState = true;
  lastWifiStrengthUpdate = millis();
  configTime(utcOffsetInSeconds, 0, "pool.ntp.org");
  tft.fillScreen(TFT_BLACK);
  tft.setCursor(10, 40);
  tft.setTextSize(3);
  tft.println("Local IP: ");
  tft.println(WiFi.localIP());
  tft.println();
  tft.println("Device ID:");
  tft.println(String(devID));
  delay(3000);
  drawMainWindow();
  ringBuzzer();
  displayWidth = tft.width();
  displayHeight = tft.height();
  //  int buttonSize = 40;  // Adjust the size of the button
  tft.setSwapBytes(true);
  // Set the color for the button
  uint16_t buttonColor = TFT_BLUE;
  mfrc522.PCD_Init();

  //drawMainWindow();
  windowtype = 0;

}
void drawMainWindow() {

  tft.fillScreen(TFT_BLACK);
  tft.fillRect(0, 0, tft.width(), 30, TFT_BLUE);
  tft.fillRect(0, 30, tft.width(), tft.height() - 30, TFT_BLACK);
  drawWiFiBars();
  updateLocalTime();
  tft.setTextSize(4);
  tft.setTextColor(TFT_GREEN);
  int yPos = 70; //(tft.height()-30-tft.fontHeight())/2;
  int xPos = (tft.width() - tft.textWidth("Welcome")) / 2;
  tft.setCursor(xPos, yPos);
  tft.println("Welcome");
  yPos = 110; //(tft.height()-30-tft.fontHeight())/2;
  xPos = (tft.width() - tft.textWidth("to")) / 2;
  tft.setCursor(xPos, yPos);
  tft.println("to");
  yPos = 150; //(tft.height()-30-tft.fontHeight())/2;
  xPos = (tft.width() - tft.textWidth("Isiwara")) / 2;
  tft.setCursor(xPos, yPos);
  tft.println("Isiwara");
  tft.drawRect(60, 60, tft.textWidth("Isiwara") + 30, 140, TFT_YELLOW);
  // drawGearIcon(buttonX, buttonY);

}

void drawWiFiBars() {
  int wifiStrength = map(WiFi.RSSI(), -100, -40, 0, 4);
  int startX = tft.width() - 18; // Adjust position as needed
  int startY = 10; // Adjust position as needed
  Serial.println(WiFi.RSSI());
  for (int i = 0; i < 4; i++) {
    int barHeight = map(i, 0, 3, 5, 20);
    if (i < wifiStrength) {
      tft.fillRect(startX, 20 - barHeight, 3, barHeight, TFT_WHITE);
    } else {
      tft.fillRect(startX, 20 - barHeight, 3, barHeight, TFT_BLUE);

    }
    startX += 4; // Adjust spacing as needed
  }
}


void updateLocalTime() {
  char newTime[20];
  struct tm timeinfo;
  if (getLocalTime(&timeinfo)) {
    strftime(newTime, 20, "%H:%M:%S", &timeinfo);

    // Compare the new time with the current time, and update only if it has changed
    if (strcmp(newTime, currentTime) != 0) {
      tft.setTextColor(TFT_BLUE);
      tft.setTextSize(2);
      tft.setCursor(5, 5); // Place the time in the top-left corner
      tft.print(currentTime);
      tft.setTextColor(TFT_WHITE);
      tft.setCursor(5, 5);
      tft.print(newTime);
      strcpy(currentTime, newTime); // Update the current time
    }
  } else {
    Serial.println("Failed to obtain time.");
  }
}

String sendStatus(String stat, String path)
{
  HTTPClient http;
  char newTime[20];
  struct tm timeinfo;
  http.begin(serverUrl + path);
  // Specify content-type header
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  // Data to send with HTTP POST
  String httpRequestData;
  if (getLocalTime(&timeinfo)) {
    strftime(newTime, 20, "%F %H:%M:%S", &timeinfo);
    httpRequestData = "dev=" + String(devID) + "&time=" + newTime + "&stat=" + stat + "&userid=" + userid;
  } else {
    httpRequestData = "dev=" + String(devID) + "&time=" + "2023-05-02" + "&stat=" + stat + "&userid=" + userid;
  }
  // Send HTTP POST request
  int httpResponseCode = http.POST(httpRequestData);
  String response;
  if (httpResponseCode == HTTP_CODE_OK)
  {
    response = http.getString();
    Serial.println("Response from Laravel: " + response);

    // Display the response on TFT
    // displayTextOnTFT(response);
  }
  else
  {
    response =  http.getString();
    Serial.println("Failed to connect to Laravel");
  }
  http.end();
  lastAlive = millis();
  return response;
}
bool rfpresent = false;
void loop() {
  if (windowtype == 0) {
    String rfidData = "";
    if (mfrc522.PICC_IsNewCardPresent() && mfrc522.PICC_ReadCardSerial()) {
      ringBuzzer();
      for (byte i = 0; i < mfrc522.uid.size; i++) {
        rfidData += String(mfrc522.uid.uidByte[i], HEX);
      }

      if (rfidData == "33311511") {
        int buttonWidth3 = 80;
        int buttonHeight3 = 40;
        int buttonGap3 = 20;
        tft.fillScreen(TFT_BLACK);
        tft.setTextSize(4);
        tft.setTextColor(TFT_ORANGE);
        tft.drawString("Searching", 50, 40);
        tft.drawString("For", 125, 90);
        tft.drawString("Student", 75, 140);
        int cancelX = (tft.width() / 2 - buttonWidth3 / 2) ;
        int cancelY = tft.height() - buttonHeight3 - 10;
        tft.fillRoundRect(cancelX, cancelY, buttonWidth3, buttonHeight3, 5, TFT_RED);
        tft.setTextSize(2);
        tft.setTextColor(TFT_WHITE);
        tft.drawString("Cancel", cancelX + 5, cancelY + 10);
        // Draw accept button
        windowtype = 1;
      } else {
        if (millis() - delaytime > 1000) {
          String response = sendStatus(rfidData, "/api/markattendence");
          Serial.println(response);
          mfrc522.PICC_HaltA();
          displayresponse(response);
          delaytime = millis();
        }
      }

    }
  } else if (windowtype == 1) {
    if (millis() - delaytime > 1000) {
      String result = fetchPendingRecordsFromLaravel();
      processPendingRecords(result);
      delaytime = millis();
    }
  } else if (windowtype == 2) {
    if (mfrc522.PICC_IsNewCardPresent() && mfrc522.PICC_ReadCardSerial()) {
      String rfidData = "";
      for (byte i = 0; i < mfrc522.uid.size; i++) {
        rfidData += String(mfrc522.uid.uidByte[i], HEX);
      }
      String http = sendStatus(rfidData, "/api/store-rfid");

      displayRFIDDataOnTFT();
      //Serial.print("hi ");
      //Serial.println(rfidData);
      drawMainWindow();
      windowtype = 0;
    }
  }
  if (timeUpdateInterval < millis() - lastTimeUpdate)
  {
    updateLocalTime();
    //Serial.println("hidd");
    lastTimeUpdate = millis();
  }
}


void ringBuzzer()
{

  //pinMode(buzzpin, OUTPUT);
  digitalWrite(buzzpin, HIGH);
  delay(200);
  digitalWrite(buzzpin, LOW);
}

String fetchPendingRecordsFromLaravel() {
  HTTPClient http;
  http.begin(serverUrl + "/api/fetch-pending-records");
  int httpCode = http.GET();

  String response;
  if (httpCode == HTTP_CODE_OK) {
    response = http.getString();
    Serial.println("Received response from Laravel:");
    Serial.println(response);
    Serial.println(httpCode);

  } else {
    Serial.print("Failed to fetch records. HTTP Code: ");
    Serial.println(httpCode);
  }

  http.end();
  return response;
}

void displayresponse(String response) {
  DynamicJsonDocument jsonDocument(1024);  // Adjust the size based on your JSON response
  deserializeJson(jsonDocument, response);

  // Iterate over each pending record
  //for (JsonVariant record : jsonDocument.as<JsonArray>()) {
    if (jsonDocument.containsKey("status") && jsonDocument["status"].is<String>()) {
 if (jsonDocument["status"] == "success")
      {
        const char* personName = jsonDocument["person"];
        drawRes(personName);
       Serial.println("Hi");
      
   }else if(jsonDocument["status"] == "error"){
    drawError( jsonDocument["message"]);
   }
  }
}
void processPendingRecords(String response) {
  // Parse the JSON response and process each pending record
  DynamicJsonDocument jsonDocument(1024);  // Adjust the size based on your JSON response
  deserializeJson(jsonDocument, response);

  // Iterate over each pending record
  for (JsonVariant record : jsonDocument.as<JsonArray>()) {
    if (record.containsKey("name") && record["name"].is<String>()) {
      userid = record["applicantid"].as<String>();
      username = record["name"].as<String>();
      username.trim();

      tft.fillScreen(TFT_BLACK);
      tft.setTextSize(4);
      tft.setTextColor(TFT_ORANGE);
      tft.drawString("Student Found", 10, 40);
      //tft.drawString("For",125,90);
      tft.setTextSize(2);
      int k = (tft.width() - tft.textWidth(username)) / 2;
      tft.drawString(username, k, 90);
      tft.setTextColor(TFT_BLUE);
      tft.setTextSize(3);
      k = (tft.width() - tft.textWidth("scan RF id now")) / 2;
      tft.drawString("scan RF id", k, 130);
      windowtype = 2;
    }
  }
}

void drawError(String names) {
  int MAX_WORDS = 3;
  char charArray[names.length() + 1];
  names.toCharArray(charArray, names.length() + 1);

  char *token = strtok(charArray, " ");
  int wordIndex = 0;
  String *wordsArray = new String[MAX_WORDS];  // Use dynamic array

  int maxi = 0;
  String mword = "";

  while (token != NULL && wordIndex < MAX_WORDS) {
    wordsArray[wordIndex] = String(token);
    if (wordsArray[wordIndex].length() > maxi) {
      maxi = wordsArray[wordIndex].length();
      mword = wordsArray[wordIndex];
    }
    wordIndex++;
    token = strtok(NULL, " ");
  }

//  int borderSize = 5;  // Adjust the border size as needed
//  int textWidthWithBorder = tft.textWidth(mword) + 2 * borderSize;
//  int textHeightWithBorder = (wordIndex + 1) * 40  + 2 * borderSize;
  int xpos; //= (tft.width() - textWidthWithBorder) / 2;
  int ypos=60;// = (tft.height() - textHeightWithBorder) / 2;

  digitalWrite(buzzpin, HIGH);
  tft.fillRect(10, 30, tft.width(), tft.height() - 30, TFT_BLACK);
//  tft.drawRect(xpos - borderSize, ypos - borderSize, textWidthWithBorder, textHeightWithBorder, TFT_YELLOW);
  tft.setTextColor(TFT_YELLOW);
  tft.setTextSize(4);
  ypos += 30;

  for (int i = 0; i < wordIndex; i++) {
    int textWidth = tft.textWidth(wordsArray[i]);
    xpos = (tft.width() - textWidth) / 2;

    // Set the cursor position and print the line
    tft.setCursor(xpos, ypos);
    tft.println(wordsArray[i]);
    ypos += 40;  // Adjust the vertical position for the next line
  }

  delete[] wordsArray;  // Don't forget to free the allocated memory

  delay(300);
  digitalWrite(buzzpin, LOW);
  delay(1500);
  drawMainWindow();
}



void drawRes(String names) {
  digitalWrite(buzzpin, HIGH);
  tft.fillRect(10, 30, tft.width(), tft.height() - 30, TFT_BLACK);
  tft.drawRect(10, 50, tft.width() - 20, 100, TFT_RED);
  tft.setTextColor(TFT_YELLOW);
  tft.setTextSize(4);
  int yPos = 75;
  int textWidth = tft.textWidth("Thank You");
  int xPos = (tft.width() - textWidth) / 2;

  // Set the cursor position and print the line
  tft.setCursor(xPos, yPos);
  tft.println("Thank You");

  // Move down for the next line
  tft.setTextColor(TFT_GREEN);
  yPos += tft.fontHeight() + 5;
  textWidth = tft.textWidth(names);
  xPos = (tft.width() - textWidth) / 2;

  // Set the cursor position and print the line
  tft.setCursor(xPos, yPos);
  tft.println(names);
  delay(300);
  digitalWrite(buzzpin, LOW);
  delay(1500);
  drawMainWindow();
}
void displayRFIDDataOnTFT() {

  tft.fillScreen(TFT_BLUE);
  tft.setTextSize(3);
  tft.setTextColor(TFT_ORANGE);
  tft.drawString(username, 50, 40);
  int  cancelX = (tft.width() / 2 - 40);
  int cancelY = tft.height() - 50;
//  tft.fillRoundRect(cancelX, cancelY, 80, 40, 5, TFT_RED);
//  tft.setTextSize(2);
//  tft.setTextColor(TFT_WHITE);
//  tft.drawString("Cancel", cancelX + 5, cancelY + 10);

  // Draw accept button
  int acceptX = cancelX + 100;
  tft.fillRoundRect(acceptX, cancelY, 80, 40, 5, TFT_BLUE);
  tft.drawString("Accept", acceptX + 5, cancelY + 10);
  //Serial.println("DDDDDDDDDDDDDD");
}
