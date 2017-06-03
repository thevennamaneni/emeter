#!/usr/bin/python

def listUsers():
    import MySQLdb
    usersList = []

    db = MySQLdb.connect(host="http://104.154.121.180",    # your host, usually localhost
                         user="energysense",         # your username
                         passwd="energysense",  # your password
                         db="energysense")        # name of the data base

    # you must create a Cursor object. It will let
    #  you execute all the queries you need
    cur = db.cursor()

    # Use all the SQL you like
    cur.execute("SHOW TABLES")

    # print all the first cell of all the rows
    for row in cur.fetchall():
        if (row[0] != "users"):
            usersList.append(row[0])

    db.close()

    return usersList


def returnStatus(deviceID):
    import MySQLdb
    ##usersList = []
    status = ""

    db = MySQLdb.connect(host="http://104.154.121.180",    # your host, usually localhost
                         user="energysense",         # your username
                         passwd="energysense",  # your password
                         db="energysense")        # name of the data base

    # you must create a Cursor object. It will let
    #  you execute all the queries you need
    cur = db.cursor()

    # Use all the SQL you like

    statement = "SELECT status FROM " + deviceID
    ##print statement
    cur.execute(statement)

    # print all the first cell of all the rows
    for row in cur.fetchall():
        status = row[0]

    db.close()
    return status

def bootUp():
    import MySQLdb
    import time
    import serial
    db = MySQLdb.connect("104.154.121.180","energysense","energysense","energysense")
    cur = db.cursor()
    orderDict = {}
    ser = serial.Serial('COM3', 115200, timeout=0)
    statement = "SELECT uid FROM users"
    cur.execute(statement)
    uidList = cur.fetchall()
    for count in range(len(uidList)):
        ##print uidList[count]
        test = str(uidList[count])
        test = test[2:-3]
        ##print test
        statement = "SELECT energy FROM " + test + " ORDER BY id DESC limit 1"
        cur.execute(statement)
        test2 = str(cur.fetchall())
        test2 = test2[2:-5]
        ##print test2
        orderDict[test] = int(test2)
        
        ##print "\n"
    ##print orderDict
    for key, value in sorted(orderDict.iteritems(), key=lambda (k,v): (v,k)):
        ##print "%s" % (key)
        print key[1:] + '.ONREL'
        ser.write(key[1:] + '.OFFREL')
        time.sleep(3)
        

        

    
    db.commit()
    db.close()
    
    
def updateReading(deviceID, current, energy, status):

    import MySQLdb
    import time
    currentTime = ""
    db = MySQLdb.connect(host="104.154.121.180",    # your host, usually localhost
                         user="energysense",         # your username
                         passwd="energysense",  # your password
                         db="energysense")        # name of the data base

    cur = db.cursor()

    currentTime = str(time.ctime())
    currentTime = currentTime[11:19]
    currentTime = currentTime + ""
    print currentTime
    statement = "INSERT INTO " + deviceID + " (timesec, current, energy, status) VALUES (" + "" + "CURRENT_TIME()" + ", '" + current + "', '" + energy + "', " + "'" + status + "'" + ")"
    print statement
    cur.execute(statement)
    db.commit()
    db.close()
    
def statusCheck():

    import MySQLdb
    import time
    import serial
    db = MySQLdb.connect(host="104.154.121.180",    # your host, usually localhost
                         user="energysense",         # your username
                         passwd="energysense",  # your password
                         db="energysense")        # name of the data base
    cur = db.cursor()
    statement = "SELECT uid FROM users"
    cur.execute(statement)
    uidList = cur.fetchall()
    ser = serial.Serial('COM3', 115200, timeout=0)
    for count in range(len(uidList)):
        ##print uidList[count]
        test = str(uidList[count])
        test = test[2:-3]
        ##print test
        statement = "SELECT status FROM " + test + " ORDER BY id DESC limit 1"
        cur.execute(statement)
        test2 = str(cur.fetchall())
        test2 = test2[3:-5]
        ##print test2
        if(test2 == "ON"):
            print test[1:] + "." + "OFFREL"
            ser.write(test[1:] + "." + "OFFREL")
        elif(test2 == "OFF"):
            print test[1:] + "." + "ONREL"
            ser.write(test[1:] + "." + "ONREL")
        time.sleep(3)
        
        ##test2 = test2[2:-5]
        ##print test2
        ##orderDict[test] = int(test2)
    

def updateEnergy():
    import MySQLdb
    import time
    import serial

    ser = serial.Serial('COM3', 115200, timeout=None)
    db = MySQLdb.connect(host="104.154.121.180",    # your host, usually localhost
                         user="energysense",         # your username
                         passwd="energysense",  # your password
                         db="energysense")
    cur = db.cursor()
    ##ser = serial.Serial('COM3', 115200, timeout=None)
    newStatus = "ON"
    statement = "SELECT uid FROM users"
    cur.execute(statement)
    uidList = cur.fetchall()
    for count in range(len(uidList)):
        ##print uidList[count]
        test = str(uidList[count])
        test = test[3:-3]
        ##print test
        ##test = test + ".energy"
        print test + ".energy"
        ##print test[8:]
        ser.write(test + ".energy")
        while ser.inWaiting:  # Or: while ser.inWaiting():
            s = ser.readline()
            s = s.strip(' \t\n\r')
            if (len(s) > 2):
                ##energyValue = int(s[8:])
                ##print s
                energyValue = float(s)
                if (energyValue < 0.0):
                    energyValue = energyValue * (-1.0)
                energyValue = energyValue * 240
                print energyValue
                break
            
        ##energyValue = 90
        if (energyValue > 8.0):
            newStatus = "OFF"
        statement = "SELECT energy FROM " + "p" + test + " ORDER BY id DESC limit 1"
        cur.execute(statement)
        test2 = str(cur.fetchall())
        test2 = test2[2:-5]
        print test2
        energyValue = energyValue + int(test2)
        statement = "SELECT status FROM " + "p" + test + " ORDER BY id DESC limit 1"
        cur.execute(statement)
        test2 = str(cur.fetchall())
        test2 = test2[3:-5]
        print test2
        if (test2 == "OFF"):
            newStatus = "OFF"
        
        print energyValue
        updateReading("p" + test, "65", str(energyValue), newStatus)
        
        
    ##ser = serial.Serial('COM3', 115200, timeout=0)

def checkSerial():
    import serial
    ser = serial.Serial('COM3', 115200, timeout=None)
    while ser.inWaiting:  # Or: while ser.inWaiting():
        s = ser.readline()
        s = s.strip(' \t\n\r')
        print s
    

def checkTransformer():
    import MySQLdb
    import time
    import serial
    db = MySQLdb.connect(host="104.154.121.180",    # your host, usually localhost
                         user="energysense",         # your username
                         passwd="energysense",  # your password
                         db="energysense")
    cur = db.cursor()
    ##ser = serial.Serial('COM3', 115200, timeout=None)
    newStatus = "ON"
    statement = "SELECT * FROM t12345"
    cur.execute(statement)
    uidList = cur.fetchall()

##print listUsers()
##updateReading("p243234235r32", "65", "80", "OFF")
##updateReading("p1018061", "0", "0", "ON")
##updateReading("p1061005", "65", "110", "ON")
##updateReading("p12345321", "65", "120", "OFF")
##import time
##bootUp()
##statusCheck()
##updateEnergy()
##checkSerial()
##while(True):
##    ##time.sleep(2000)
##    statusCheck()
##    updateEnergy()
