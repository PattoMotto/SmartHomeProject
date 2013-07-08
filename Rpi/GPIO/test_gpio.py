import RPi.GPIO as GPIO
import time 

GPIO.setmode(GPIO.BOARD)

GPIO.setup(22, GPIO.OUT)
GPIO.setup(16, GPIO.OUT)
GPIO.setup(12, GPIO.OUT)

while True:
  GPIO.output(12, True)
  time.sleep(0.2)
  GPIO.output(12, False)
  GPIO.output(16, True)
  time.sleep(0.2)
  GPIO.output(16, False)
  GPIO.output(22, True)
  time.sleep(0.2)
  GPIO.output(22, False)
