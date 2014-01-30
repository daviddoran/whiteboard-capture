import RPi.GPIO as GPIO
import time
from subprocess import call

def main():
    GPIO.setmode(GPIO.BOARD)
    channel = 12
    GPIO.setup(channel, GPIO.IN, pull_up_down=GPIO.PUD_UP)
    while True:
        try:
            print "Waiting for button press..."
            GPIO.wait_for_edge(channel, GPIO.FALLING)
            print "Capturing..."
            call(["./pipeline.sh"])
            print "Ended capture."
        except KeyboardInterrupt:
            GPIO.cleanup()

if __name__ == "__main__":
    main()
