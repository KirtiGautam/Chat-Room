import mysql.connector
import time

mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    passwd="pwdpwd",
    database="test"
)

mycursor = mydb.cursor()

# sql = "SELECT sender,text FROM messages WHERE sender='KGautam' AND reciever='Dev' ORDER BY time ASC"
# mycursor.execute(sql)
# myresult = mycursor.fetchall()

# for x in myresult:
#     if(x[0]=='Kgautam')
#         print(x)

for i in range(1100, 1161): 
    if(i%2==0):
        sql = "INSERT INTO messages (sender, text, reciever) VALUES ('Dev', '"+str(i)+"', 'KGautam')"
        mycursor.execute(sql)
        time.sleep(1)
    else:        
        sql = "INSERT INTO messages (sender, text, reciever) VALUES ('KGautam', '"+str(i+1)+"', 'Dev')"
        mycursor.execute(sql)
        time.sleep(1)
    mydb.commit()