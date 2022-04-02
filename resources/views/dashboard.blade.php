<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>智能家居控制系统</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/paho-mqtt.js" type="text/javascript"></script>
    <script src="js/mqtt.min.js" type="text/javascript"></script>
</head>


<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')
    </div>



    <div class="home">
        <img src="images/湿度.png" alt="湿度" />
        <p>温度：</p>
        <p  id="temp">26℃</p>
    </div>
    <div class="home">
        <img src="./images/温度.png" alt="温度" />
        <p >湿度：</p>
        <p id="humi">56%</p>
    </div>
    <div class="home">
        <img src="./images/有害气体.png" alt="有害气体" />
        <p>有害气体浓度：</p>
        <p>2.2</p>
    </div>
    <div class="home">
        <img src="./images/灯开关.png" alt="灯" />
        <p>灯: <span>开</span></p>
        <input id="lamp" type="checkbox" class="switch_1" >
    </div>
    <div class="home">
        <img src="./images/插座.png" alt="灯" />
        <p>插座: <span>开</span></p>

        <input type="checkbox" class="switch_1">

    </div>
    <div class="home">
        <img src="./images/风扇.png" alt="灯" />
        <p>风扇: <span>开</span></p>

        <input type="checkbox" class="switch_1">

    </div>
    <div class="home">
        <img src="./images/窗户-关.png" alt="灯" />
        <p>窗户: <span>开</span></p>
        <input type="checkbox" class="switch_1">
    </div>
    <div class="home">
        <img src="./images/门.png" alt="灯" />
        <p>门: <span>开</span></p>
        <input type="checkbox" class="switch_1">
    </div>
    <div class="home">
        <img src="./images/安防模式.png" alt="灯" />
        <p>安防模式: <span>开</span></p>
        <input type="checkbox" class="switch_1">
    </div>


</body>
<script>
    //事件监听，发送消息
    document.getElementById("lamp").addEventListener("click", displayDate);
    function displayDate(){
    if(document.getElementById("lamp").checked){
        client.publish('testtopic', "{ \"lamp\":1 }");
    }
    else
    {
        client.publish('testtopic', "{ \"lamp\":0}");
    }
    }
    // 
</script>

<script>
    var hostname = "152.32.170.86"
    var port = 8083
    var clientID = "qing";
    var topic = "testtopic";
    // 创建客户端实例
    client = new Paho.MQTT.Client(hostname, Number(port), clientID);

    // 设置回调处理程序
    client.onConnectionLost = onConnectionLost;
    client.onMessageArrived = onMessageArrived;

    // 连接客户端
    client.connect({
        onSuccess: onConnect,
        userName: "qing",
        password: "666666"
    });


    // 连接客户端时调用
    function onConnect() {
        // Once a connection has been made, make a subscription and send a message.
        console.log("onConnect");
        client.subscribe(topic);
        message = new Paho.MQTT.Message("Hello");
        message.destinationName = "World";
        client.send(message);
    }

    // 错误处理
    function onConnectionLost(responseObject) {
        if (responseObject.errorCode !== 0) {
            
            console.log("onConnectionLost:" + responseObject.errorMessage);
        }
    }

    // 接收消息
    function onMessageArrived(message) {
        var obj = eval('(' + message.payloadString + ')');
        document.getElementById('temp').innerHTML = obj.temp;
        document.getElementById('humi').innerHTML = obj.humi;
        console.log("onMessageArrived:" + message.payloadString);
        if(obj.lamp==1){
            document.getElementById("lamp").checked=true
        }else
        {
            document.getElementById("lamp").checked=false
        }
        
    }
    
</script>


</html>