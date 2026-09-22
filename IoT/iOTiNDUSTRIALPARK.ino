#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>

const char* ssid = "WIFI-EDUC";
const char* password = "ac3ce7ss0-EDUC";

const char* serverUrl =
    "http://10.141.130.92/INDUSTRIAL_PARK/public/api/vagas";

#define TRIG 14
#define ECHO 12

#define LED_VERDE 21
#define LED_VERMELHO 22

#define DISTANCIA_LIMITE 100.0

#define VAGA_ID 2

#define TIMEOUT_ECHO 30000

unsigned long ultimoSensor = 0;
unsigned long ultimaAPI = 0;

const unsigned long INTERVALO_SENSOR = 500;
const unsigned long INTERVALO_API = 3000;

float distancia = 999;


// ==========================================
// CONECTAR WI-FI
// ==========================================

void conectarWifi() {

  Serial.println();
  Serial.println("Conectando ao Wi-Fi...");

  WiFi.begin(
    ssid,
    password
  );

  int tentativas = 0;

  while (
    WiFi.status() != WL_CONNECTED &&
    tentativas < 20
  ) {

    delay(500);

    Serial.print(".");

    tentativas++;
  }

  Serial.println();

  if (
    WiFi.status() == WL_CONNECTED
  ) {

    Serial.println(
      "Wi-Fi conectado!"
    );

    Serial.print("IP: ");

    Serial.println(
      WiFi.localIP()
    );

  } else {

    Serial.println(
      "Wi-Fi nao conectado."
    );
  }
}


// ==========================================
// MEDIR DISTÂNCIA
// ==========================================

float medirDistancia() {

  digitalWrite(
    TRIG,
    LOW
  );

  delayMicroseconds(2);

  digitalWrite(
    TRIG,
    HIGH
  );

  delayMicroseconds(10);

  digitalWrite(
    TRIG,
    LOW
  );

  long duracao = pulseIn(
    ECHO,
    HIGH,
    TIMEOUT_ECHO
  );

  // Sem retorno do sensor
  if (
    duracao == 0
  ) {

    return 999;
  }

  float distanciaCalculada =
      duracao * 0.0343 / 2.0;

  return distanciaCalculada;
}


// ==========================================
// CONTROLAR LEDs
// ==========================================

void controlarLeds(
  float distanciaAtual
) {

  // CARRO DETECTADO
  if (
    distanciaAtual <=
    DISTANCIA_LIMITE
  ) {

    digitalWrite(
      LED_VERMELHO,
      HIGH
    );

    digitalWrite(
      LED_VERDE,
      LOW
    );

  }

  // VAGA LIVRE
  // Também entra aqui quando distancia = 999
  else {

    digitalWrite(
      LED_VERMELHO,
      LOW
    );

    digitalWrite(
      LED_VERDE,
      HIGH
    );
  }
}


// ==========================================
// ATUALIZAR STATUS DA VAGA - PUT
// ==========================================

void atualizarStatusVaga() {

  if (
    WiFi.status() != WL_CONNECTED
  ) {

    Serial.println(
      "PUT: Wi-Fi desconectado"
    );

    return;
  }

  HTTPClient http;

  String url =
      String(serverUrl) +
      "/atualizar/" +
      String(VAGA_ID);

  http.begin(url);

  http.addHeader(
    "Content-Type",
    "application/json"
  );

  StaticJsonDocument<128> json;

  // ========================================
  // DEFINIR STATUS
  // ========================================

  if (
    distancia <=
    DISTANCIA_LIMITE
  ) {

    json["VAG_STATUS"] =
        "OCUPADO";

  } else {

    // Inclui distancia = 999
    json["VAG_STATUS"] =
        "LIVRE";
  }

  String corpoJson;

  serializeJson(
    json,
    corpoJson
  );

  Serial.println();
  Serial.println(
    "Atualizando status da vaga..."
  );

  Serial.print(
    "URL: "
  );

  Serial.println(
    url
  );

  Serial.print(
    "JSON: "
  );

  Serial.println(
    corpoJson
  );

  // ========================================
  // PUT
  // ========================================

  int codigoResposta =
      http.PUT(
        corpoJson
      );

  Serial.print(
    "PUT -> HTTP: "
  );

  Serial.println(
    codigoResposta
  );

  // ========================================
  // RESPOSTA
  // ========================================

  if (
    codigoResposta > 0
  ) {

    String resposta =
        http.getString();

    Serial.print(
      "Resposta: "
    );

    Serial.println(
      resposta
    );

  } else {

    Serial.print(
      "Erro PUT: "
    );

    Serial.println(
      http.errorToString(
        codigoResposta
      )
    );
  }

  http.end();
}


// ==========================================
// SETUP
// ==========================================

void setup() {

  Serial.begin(9600);

  delay(1000);

  Serial.println();
  Serial.println(
    "================================="
  );

  Serial.println(
    "   INDUSTRIAL PARK - ESP32"
  );

  Serial.println(
    "================================="
  );


  // ========================================
  // SENSOR
  // ========================================

  pinMode(
    TRIG,
    OUTPUT
  );

  pinMode(
    ECHO,
    INPUT
  );

  digitalWrite(
    TRIG,
    LOW
  );


  // ========================================
  // LEDs
  // ========================================

  pinMode(
    LED_VERDE,
    OUTPUT
  );

  pinMode(
    LED_VERMELHO,
    OUTPUT
  );

  digitalWrite(
    LED_VERDE,
    HIGH
  );

  digitalWrite(
    LED_VERMELHO,
    LOW
  );


  // ========================================
  // WI-FI
  // ========================================

  conectarWifi();

  Serial.println();

  Serial.println(
    "Sistema iniciado!"
  );

  Serial.println(
    "Comecando leituras..."
  );

  Serial.println();
}


// ==========================================
// LOOP
// ==========================================

void loop() {

  unsigned long agora =
      millis();


  // ========================================
  // LEITURA DO SENSOR
  // ========================================

  if (
    agora - ultimoSensor >=
    INTERVALO_SENSOR
  ) {

    ultimoSensor = agora;

    distancia =
        medirDistancia();

    controlarLeds(
      distancia
    );


    // ======================================
    // MOSTRAR STATUS
    // ======================================

    Serial.print(
      "Distancia: "
    );

    if (
      distancia >= 999
    ) {

      Serial.println(
        "sem retorno"
      );

      Serial.println(
        "STATUS: VAGA LIVRE"
      );

    } else {

      Serial.print(
        distancia,
        1
      );

      Serial.println(
        " cm"
      );

      if (
        distancia <=
        DISTANCIA_LIMITE
      ) {

        Serial.println(
          "STATUS: VAGA OCUPADA"
        );

      } else {

        Serial.println(
          "STATUS: VAGA LIVRE"
        );
      }
    }

    Serial.println(
      "-----------------------------"
    );
  }


  // ========================================
  // PUT PARA API
  // ========================================

  if (
    agora - ultimaAPI >=
    INTERVALO_API
  ) {

    ultimaAPI = agora;

    // ======================================
    // AGORA O PUT É SEMPRE EXECUTADO
    // ======================================

    atualizarStatusVaga();

    Serial.println(
      "============================="
    );
  }
}