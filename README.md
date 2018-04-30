# water_park_my_masks

part เริ่มต้น : https://angsila.cs.buu.ac.th/~58160266/reatful/public/index.php/

/api
    /v1
        GET : waterparks   -> return status , result (all) id , picture , detail
        GET : waterpars/{id} -> return status , result (one) id , picture ,detail
        GET : missioncount/{email} -> return status , result num of pass mission
        
        POST : members -> post email , return status, result id , email , status 12 waterparks
        POST : misstion -> post email , id ('id of waterpark') , return status
        
        
