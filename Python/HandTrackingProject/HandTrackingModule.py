import cv2
import mediapipe as mp
import time

# address = "https://192.168.1.14:8080/video"
# cap.open(address)

class handDetector():
    def __init__(self, mode=False, maxHands=2,detectionConfidence=0.5,traackConfidence=0.5):
        self.mode = mode
        self.maxHands = maxHands
        self.detectCon = detectionConfidence
        self.trackCon = traackConfidence

        self.mpHands = mp.solutions.hands
        self.hands = self.mpHands.Hands(self.mode,self.maxHands,1,self.detectCon,self.trackCon)
        self.mpDraw = mp.solutions.drawing_utils

    def findHands(self, img,draw=True):
        imgRGB = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
        self.results = self.hands.process(imgRGB)
        # print(results.multi_hand_landmarks)

        if self.results.multi_hand_landmarks:
            for handLms in self.results.multi_hand_landmarks:
                if draw:
                    self.mpDraw.draw_landmarks(img, handLms, self.mpHands.HAND_CONNECTIONS)
        return img

    def findPosition(self, img, handNo=0, draw=True):
        lmList = []
        if self.results.multi_hand_landmarks:
            myHand = self.results.multi_hand_landmarks[handNo]

            for id, lm in enumerate(myHand.landmark):
                # print(id,lm)
                h, w, c = img.shape
                cx, cy = int(lm.x * w), int(lm.y * h)
                # print(id,cx,cy)
                lmList.append([id,cx,cy])
                if draw:
                    # if id % 4 == 0 and id != 0:
                    cv2.circle(img, (cx, cy), 15, (255, 0, 255), cv2.FILLED)

                # if id==4:
                # cv2.circle(img, (cx, cy), 15, (255, 0, 255), cv2.FILLED)
        return lmList