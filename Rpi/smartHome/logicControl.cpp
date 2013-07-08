#include <mysql.h>
#include "stdio.h"
#include <string>
#include <vector>
#include <iostream>
using namespace std;

typedef struct{
string time;
string cmd;
} db;

vector<db> connectDB(){
  vector<db> data;
  db elem;
  data.clear();
  char *sql_dt[3]={"root","qwerty","smart_home"};
  MYSQL *con = mysql_init(NULL);
  mysql_real_connect(con, "localhost", sql_dt[0], sql_dt[1],sql_dt[2], 0, NULL, 0);
  mysql_query(con, "select * from timer");
  MYSQL_RES *res = mysql_store_result(con);
  MYSQL_ROW row;
  while((row = mysql_fetch_row(res))){
   elem.time = row[0];
   elem.cmd = row[1];
   data.push_back(elem);
//   printf("DateTime=>%s cmd=>%s\n",row[0],row[1]);
  }
  mysql_close(con);
  return data;
}
string getTime(void) {
  time_t t1;
  struct tm * t;
  time(&t1);
  // UTC time
  // tim = gmtime(&t1);
  // Local time
  t = localtime(&t1);
  char str[50];
  sprintf(str,"%04d-%02d-%02d %02d:%02d:%02d",
	t->tm_year+1900,t->tm_mon+1,t->tm_mday,
	t->tm_hour, t->tm_min,t->tm_sec);
  return str;
}
void main(int argc, char **argv)
{
  vector<db> data = connectDB();
  int s=data.size();
  for(int i = 0;i < s;i++){
    cout << data[i].time << ">>>" << data[i].cmd << endl;
  }

}

