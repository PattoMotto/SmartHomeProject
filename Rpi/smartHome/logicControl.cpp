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
typedef struct{
int y,m,d,h,i;
} Time;

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
  t = gmtime(&t1); //uncomment this line if u want utc time
  // Local time
  //t = localtime(&t1); //uncomment this line if u want local time
  char str[50];
  sprintf(str,"%04d-%02d-%02d %02d:%02d:%02d",
	t->tm_year+1900,t->tm_mon+1,t->tm_mday,
	t->tm_hour, t->tm_min,t->tm_sec);
  return str;
}
Time strToTime(string s){
	Time t;
	t.y = atoi(s.substr(0,2));
	t.m = atoi(s.substr(3,2));
	t.d = atoi(s.substr(6,2));
	t.h = atoi(s.substr(9,2));
	t.i = atoi(s.substr(12,2));
	cout << "str->time" << t.y << t.m << t.d << t.h << t.i << endl;
	return t;
}
/**compare the time if 1st paremeter greater than 2nd return 1 if equal return 0 less than return -1**/
int compareTime(string s1,string s2){
	Time t1=strToTime(s1),t2=strToTime(s2);
	if(t1.y > t2.y)
		return 1;
	else if(t1.y == t2.y){
		if(t1.m > t2.m)
			return 1;
		else if(t1.m == t2.m){
			if(t1.d > t2.d)
				return 1;
			else if(t1.)
		}
	}
	return -1;
}
void main(int argc, char **argv)
{
  vector<db> data = connectDB();
  int s=data.size();
  for(int i = 0;i < s;i++){
    cout << data[i].time << ">>>" << data[i].cmd << endl;
	strToTime(data[i].time);
  }
}


