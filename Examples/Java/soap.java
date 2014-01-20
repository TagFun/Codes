/////////////////////////////////////////////
// ** SOAP REQUEST **

POST /palvelin/palvelu HTTP/1.0?
Content-Type: text/xml; charset=utf-8?
Accept: application/soap+xml, application/dime, multipart/related, text/ *?
User-Agent: Client/1.1beta?
Host: localhost?
Cache-Control: no-cache?
Pragma: no-cache?
SOAPAction: ""?
Content-Length: 408?
?
<?xml version="1.0" encoding="UTF-8"?>
<soapenv:Envelope xmlns:soapenv=http://schemas.xmlsoap.org/soap/envelope/
xmlns:xsd=http://www.w3.org/2001/XMLSchema
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
<soapenv:Body>
 <haeValuutta soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
   <arg0 xsi:type="xsd:string">USD</arg0>
  </haeValuutta>
</soapenv:Body>
</soapenv:Envelope>

/////////////////////////////////////////////
// ** SOAP RESPONSE **

HTTP/1.1 200 OK?
Set-Cookie: JSESSIONID=E3F86F3275A9E2D937A08E1B1CD098F9; Path=/axis?
Content-Type: text/xml; charset=utf-8?
Date: Thu, 06 Feb 2009 14:31:18 GMT?
Server: Apache?
Connection: close?
?
<?xml version="1.0" encoding="UTF-8"?>
<soapenv:Envelope xmlns:soapenv=http://schemas.xmlsoap.org/soap/envelope/
xmlns:xsd=http://www.w3.org/2001/XMLSchema
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
<soapenv:Body>
 <haeValuuttaResponse soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
  <haeValuuttaReturn xsi:type="xsd:double">1.081</haeValuuttaReturn>
 </haeValuuttaResponse>
</soapenv:Body>
</soapenv:Envelope>