
if ($response.statusCode != 200) {
  $done(Null);
}

var body = $response.body;
var obj = JSON.parse(body);
var title = obj['country'];
var subtitle = obj['city'] + ' ' + obj['isp'];
var ip = obj['ip'];
var description = obj['country'] + '\n' + obj['city'] + '\n' + obj['isp'];

$done({title, subtitle, ip, description});
