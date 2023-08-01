import psycopg2
import datetime

# start restore splkk
conn = psycopg2.connect(
    "host=127.0.0.1 dbname=spaqs user=spaqs-user password=spaqs-password")
cur = conn.cursor()

dateT = datetime.date.today()
print(dateT)

get_iklan  = "SELECT iklan_perolehan.id, mohon_no_perolehan.tarikh_jangka_iklan FROM iklan_perolehan INNER JOIN mohon_no_perolehan ON iklan_perolehan.mohon_no_perolehan_id=mohon_no_perolehan.id_perolehan WHERE (iklan_perolehan.status_iklan_id = 2 OR iklan_perolehan.status_iklan_id = 3) AND mohon_no_perolehan.tarikh_jangka_iklan < '%s'"%dateT

cur.execute(get_iklan)
print("Start Cron")
result = cur.fetchall()
iklan_tutup = [item for item in result]

if iklan_tutup:
    for iklan in iklan_tutup:
        sql_update_iklan = """UPDATE iklan_perolehan set status_iklan_id = 6, justifikasi_batal = 'PEMBATALAN OLEH SISTEM SPAQS' WHERE id = %s"""% iklan[0]
        cur.execute(sql_update_iklan)
        conn.commit()
        print("Selesai update status_iklan")
else:
    print("Tiada Data Untuk Dikemaskini")

# closing database connection.
if conn:
    cur.close()
    conn.close()
    print("PostgreSQL connection is closed")
# end restore


