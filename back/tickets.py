import mysql.connector

conn_object=mysql.connector.connect(host='localhost',user='adil',password='jukilo999',database='webMKM')

cur = conn_object.cursor()


tickets_query = """INSERT INTO tickets VALUES
(1, 'Semei', 'Almaty', '2022-12-04', '2022-12-06', 15000)"""
tickets_query1 = """INSERT INTO tickets VALUES
(2, 'Aqtobe', 'Oral', '2022-12-06', '2022-12-07', 12000)"""
tickets_query2 = """INSERT INTO tickets VALUES
(3, 'Aqtau', 'Zhanaozen', '2022-12-07', '2022-12-10', 16000)"""
tickets_query3 = """INSERT INTO tickets VALUES
(4, 'Oskemen', 'Zaisan', '2022-12-11', '2022-12-13', 10000)"""
tickets_query4 = """INSERT INTO tickets VALUES
(5, 'Almaty', 'Taldyqorgan', '2022-12-15', '2022-12-20', 9000)"""


cur.execute(tickets_query)
cur.execute(tickets_query1)
cur.execute(tickets_query2)
cur.execute(tickets_query3)
cur.execute(tickets_query4)


conn_object.commit()



cur.close()
conn_object.close()


