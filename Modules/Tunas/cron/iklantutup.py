import psycopg2
import datetime

# update iklan tutup spaqs
conn = psycopg2.connect(
    "host=127.0.0.1 dbname=spaqs user=spaqs-user password=spaqs-password")
cur = conn.cursor()

dateT = datetime.date.today()
print(dateT)
#get iklan from table iklan perolehan from spaqs
get_iklan  = """SELECT id FROM iklan_perolehan WHERE status_iklan_id = 4 AND DATE(tarikh_waktu_tutup) <= '%s'"""% dateT

cur.execute(get_iklan)
print("Start")
result = cur.fetchall()
iklan_tutup = [item for item in result]
print(iklan_tutup)

for iklan in iklan_tutup:

    sql_update_iklan = """UPDATE iklan_perolehan set jadual_harga_status = 'TINDAKAN' , status_iklan_id = 5 WHERE id = %s"""% iklan[0]
    cur.execute(sql_update_iklan)
    conn.commit()
    print("Done update status_iklan and jadual_harga_status")

# closing database connection.
if conn:
    cur.close()
    conn.close()
    print("PostgreSQL connection is closed")
# end update iklan tutup spaqs


