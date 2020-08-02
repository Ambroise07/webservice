#coding:utf-8
import requests,sys,json
apikey = "AZSD54456524F2ERTYUIy445d7AS"
class SystemMcf :
    "Module de contrôle de facturation (MCF)"

    domaine = 'http://localhost:8000'
    
    def __init__(self,apikey):
        self.apikey = apikey
        #self.ifu = ifu   
    
    def getRequest(self,url):
        "Envoie les requestes en get au serveur HTTP"
        response =  requests.get(url)  
        if response.status_code == 200 :
            return json.loads(response.text)['data']
        else :
            return 0
    def postRequest(self,url,data={}):
        "Envoie les requestes en post au serveur HTTP"
        response = requests.post(url,data)
        if response.status_code == 200 :
            #return response.text
            response = json.loads(response.text)
            if response['data'] == None :
                return response['message']
            return response['data']
        else :
            return 0
        
    def Commande_C1h(self) :
        "ÉTAT DE MCF || Cette commande est utilisée pour vérifier l'état de MCF "
        url = self.__class__.domaine+'/api/mcf-status/{}'.format(self.apikey)
        return self.getRequest(url)
          
    def Commande_C2h(self) :
        "ÉTAT DE LA CONNEXION DU SERVEUR || Cette commande permet de vérifier le statut de la connexion MCF au serveur d'Autorité"
        url = self.__class__.domaine+'/api/serveur-status/{}'.format(self.apikey)
        return self.getRequest(url)
        
    def Commande_2Bh(self) :
        "INFO SUR LE CONTRIBUABLE || Cette commande est utilisée pour vérifier les informations actuelles sur le contribuable qui sont configurées dans MCF"
        url = self.__class__.domaine+'/api/entreprise-info/{}'.format(self.apikey)
        return self.getRequest(url)
        
    def Commande_C0h(self,data) :
        "DÉBUT DE LA NOUVELLE FACTURE || Cette commande est utilisée pour démarrer une nouvelle facture"
        url = self.__class__.domaine+'/api/nouvelle-facture/{}'.format(self.apikey)
        return self.postRequest(url,data)
        
    def Commande_31h(self,data:dict,token:str):
        "ENREGISTREMENT D'UN NOUVEL ARTICLE || Cette commande est utilisée pour l'enregistrement d'articles (biens ou services) sur facture"
        url = self.__class__.domaine+'/api/nouveau-produit/{}/{}'.format(facture,self.apikey)
        return self.postRequest(url,data)
        
    def Commande_33h(self,token:str) :
        "SOUS-TOTAL || Cette commande est utilisée pour vérifier le montant total enregistré sur la facture"
        url = self.__class__.domaine+'/api/sous-total/{}/{}'.format(token,self.apikey)
        return self.getRequest(url)
        
    def Commande_35h(self,token:str,montantTotal, data:dict):
        """
        TOTAL \n
        Cette commande permet de confirmer la facture en enregistrant le(s) paiement(s). Si cette commande n'est pas émise avant la commande 38h, la facture est annulée. En cas de mélange de moyens de paiement, la commande peut être utilisée plusieurs fois. La commande peut être utilisée avec ou sans données (la partie des données est optionnelle). Si aucune donnée n'est définie, MCF enregistre automatiquement le paiement en espèces avec le montant du paiement égal au montant total de la facture. Si la valeur de données est définie, MCF enregistre le type de paiement et la valeur  du paiement. La commande renvoie le reste / l'excédent des paiements enregistrés        
        """
        url = self.__class__.domaine+'/api/total/{}/{}/{}'.format(token,montantTotal,self.apikey)
        if not bool(data) :
            return self.getRequest(url)
        else :
            return self.postRequest(url,data)
        
    def Commande_38h(self,token:str) :
        """
        FIN DE FACTURE
        Cette commande doit être utilisée juste après la commande (35h) pour finaliser la
        facture et obtenir le code de facture.
        Si la commande (35h) n'a pas été émise avant cette commande, la facture actuelle
        sera fermée et annulée.
        """
        url = self.__class__.domaine+'/api/fin-facture/{}/{}'.format(token,self.apikey)
        return self.getRequest(url)


P = SystemMcf("AZERTYUIOP12345678")
data = {
    'tc':45
}
print(P.Commande_2Bh())