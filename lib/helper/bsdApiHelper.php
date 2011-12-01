<?PHP

function bsdApiUrl($gitGive, $appClass, $rest = array())
{

   $bsdApiUser = Doctrine::getTable('bsdApiUser')->findOneByGuardId(sfContext::getInstance()->getUser()->getGuardUser()->getId());
   $token = $bsdApiUser->getApiKey();

   switch(strtolower($gitGive))
   {
         case("give"):
                return bsdApiGiveUrl($appClass, $token, $rest);
                break;
         case("get"):
                return bsdApiGetUrl($appClass, $token, $rest);
                break;
   }
   
}

function bsdApiGetUrl($appClass, $token , $rest = array())
{
   $params = array_merge(array("token" => $token, "appClass" => strtolower($appClass)), $rest);
   return url_for2('api_get', $params);
}

function bsdApiGiveUrl($appClass, $token, $rest = array())
{
   if(!isset($rest['isNew']))
       $rest['isNew'] = true;

   $params = array_merge(array("token" => $token, "appClass" => strtolower($appClass)), $rest);
   return url_for2('api_give', $params);
   }

