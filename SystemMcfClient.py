#coding:utf-8


class SystemMcfClient :
    
    
    CommandeSfe = ['SOH','LEN','SEQ','CMD','DATA','AMB','BCC','ETX']
    ResponseMcf = ['SOH','LEN','SEQ','CMD','DATA','BRK','STA','AMB','BCC','ETX']
    
    def getUserInput(self) :
        self.DATA = {}
        SOH = input("_ ")
        if  SOH == self.__class__.CommandeSfe[0]:
           pass
        else :
            self.getUserInput()
        LEN = input(self.__class__.CommandeSfe[1] + ": ")
        if not LEN :
            pass
        SEG = input(self.__class__.CommandeSfe[2] + ": ")
        if not SEG :
            pass
        CMD = input(self.__class__.CommandeSfe[3] + ": ")
        if not CMD :
            pass
        else :
            if CMD in self.dataOption():
                print('DATA :')
                for i in range(len(self.dataOption()[CMD])) :
                    data = input(self.dataOption()[CMD][i] + ": ")
                    self.DATA[self.dataOption()[CMD][i]] = data     
            else :
                pass
        if not bool(self.DATA) :
            DATA = input(self.__class__.CommandeSfe[4] + ": ")
            
        AMB = input(self.__class__.CommandeSfe[5] + ": ")
        if not AMB :
            pass
        BCC = input(self.__class__.CommandeSfe[6] + ": ")
        if not BCC :
            pass
        ETX = input(self.__class__.CommandeSfe[7] + ": ")
        if not ETX :
            pass
        return {'SEG':SEG,'CMD':CMD,'DATA':self.DATA,'AMB':AMB}
    
    def dataOption(self) :
       return  {
            '2Bh' : [
                'I0',
                'I1',
                'I2',
                'I3',
                'I4'
            ],
            'C0h': [
                'OPID',
                'OPNOM',
                'IFU',
                'TAX',
                #{'TAX':['TAXA', 'TAXB','TAXC','TAXD' ]},
                'VT',
                #{'VT': ['FV', 'CV','EV', 'EC'   ]},
                #{'RT':['FA','CA', 'EA','ER' ]},
                'RT',
                #{'RN':[ 'NIM','TC' ]},
                'RN',
                'CIFU',
                'CNOM',
                'CEX'
            ],
            '31h' : [
                'NOM',
                'LF',
                'DESC',
                'TAB',
                #{'TAX' : ['A','B','C','D','E','F']},
                'TAX',
                'PR',
                'QT',
                'TS',
                'TSDESC',
                'PRORIG',
                'PRDESC'
            ],
            '35h' : [
                'PA',
                #{'PA' : ['V','C','M','D','E','A']},
                'MT'
            ]
            
        }

    def mcfResponse(self,amb,seg,cmd,data,error=False) :
        print("########################")
        if error :
            return 'NAK 15h'
        print(self.__class__.ResponseMcf[0])
        print(self.__class__.ResponseMcf[1]+" : "+ str(len(data)))
        print(self.__class__.ResponseMcf[2]+ " : "+ seg)
        print(self.__class__.ResponseMcf[3] + " : "+cmd)
        print(self.__class__.ResponseMcf[4] + " : ",end="")
        for key, value in data.items() :
            print(str(value)+" "+amb,end=" ")
        print()    
        print(self.__class__.ResponseMcf[5]+" -----------------------")
        import random
        print(self.__class__.ResponseMcf[6] + " "+str(random.randint(1,4))+"."+str(random.randint(1,7)))
        print(self.__class__.ResponseMcf[7]+" -----------------------")
        print(self.__class__.ResponseMcf[8]+" : "+str(str(len(data))+str(int(random.random()))))
        print(self.__class__.ResponseMcf[9])
        
    #
    def executeCmd(self):
        self.factureId = 0
        self.montantTotal = 0
        from  SystemMCF import SystemMcf,apikey
        response =  self.getUserInput()
        _initSystemMCF = SystemMcf(apikey,4545)
        sig = response['SEG']
        cmd = response['CMD']
        data = response['DATA']
        amb = response['AMB']
        if cmd == 'C1h' :
           h1C = _initSystemMCF.Commande_C1h()
           if h1C == 0 :
               print(self.mcfResponse('','','','','',True))
           else :
               self.mcfResponse(amb,sig,cmd,h1C)
        elif cmd == 'C2h' :
           h2C = _initSystemMCF.Commande_C2h()
           if h2C == 0 :
               print(self.mcfResponse('','','','','',True))
           else :
               self.mcfResponse(amb,sig,cmd,h2C)
        elif cmd == '2Bh' :
           h2B = _initSystemMCF.Commande_2Bh()
           if h2B == 0 :
                print(self.mcfResponse('','','','','',True))
           else :
               self.mcfResponse(amb,sig,cmd,h2B)
        elif cmd == 'C0h' :
            C0h = _initSystemMCF.Commande_C0h(data)
            if C0h == 0 :
                print(self.mcfResponse('','','','','',True))
            else :
               self.factureId = C0h['factureId']
               try :
                   del C0h['factureId']
               except:
                   pass
               self.mcfResponse(amb,sig,cmd,C0h)
        elif cmd == '31h' :
            h31 = _initSystemMCF.Commande_31h(data,self.factureId)
            if h31 == 0 :
                print(self.mcfResponse('','','','','',True))
            else :
               self.mcfResponse(amb,sig,cmd,h31)

               
        elif cmd == '33h' :
            h33 = _initSystemMCF.Commande_33h(self.factureId)
            
            if h33 == 0 :
                print(self.mcfResponse('','','','','',True))
            else :
               self.mcfResponse(amb,sig,cmd,h33)
               self.montantTotal = h33['MV']
               
        elif cmd == '35h' :
           h35 = _initSystemMCF.Commande_35h(self.factureId,self.montantTotal,data)
           if h35 == 0 :
                print(self.mcfResponse('','','','','',True))
           else :
               self.mcfResponse(amb,sig,cmd,h35)
               
        elif cmd == '38h' :
            h38 = _initSystemMCF.Commande_38h(self.factureId)
            if h38 == 0 :
                print(self.mcfResponse('','','','','',True))
            else :
               self.mcfResponse(amb,sig,cmd,h38)
               
        else :
            pass
            #you must do somethin             
        self.executeCmd()
#VTRTRN
start = SystemMcfClient()
try :
    start.executeCmd()
except KeyboardInterrupt :
    pass