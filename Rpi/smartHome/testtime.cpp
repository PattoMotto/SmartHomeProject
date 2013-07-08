#include "iostream" 
#include "stdio.h"
#include "time.h"
#include "string"
using namespace std; 
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
int main() {
  string t = getTime();
  cout << "Hello" << t << endl;
  return 0;
}
