<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>智能家居控制系统</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/paho-mqtt.js" type="text/javascript"></script>
</head>


<body class="font-sans antialiased">


    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')


    </div>
    <div class="home">
        <img src="images/湿度.png" alt="湿度" />
        <p id="temp">温度：</p>
        <p>26℃</p>
    </div>
    <div class="home">
        <img src="./images/温度.png" alt="温度" />
        <p id="humi">湿度：</p>
        <p>56%</p>
    </div>
    <div class="home">
        <img src="./images/有害气体.png" alt="有害气体" />
        <p>有害气体浓度：</p>
        <p>2.2</p>
    </div>
    <div class="home">
        <img src="./images/灯开关.png" alt="灯" />
        <p>灯: <span>开</span></p>
        <button onclick="sendMessage()"></button>
    </div>
    <div class="home">
        <img src="./images/插座.png" alt="灯" />
        <p>插座: <span>开</span></p>

        <input type="checkbox" class="switch_1" onclick="sendMessage()">

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
<script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
<script>
    // Create a client instance
    client = new Paho.MQTT.Client("152.32.170.86", Number(8083), "clientId");

    // set callback handlers
    client.onConnectionLost = onConnectionLost;
    client.onMessageArrived = onMessageArrived;

    // connect the client
    client.connect({
        onSuccess: onConnect,
        userName: "clay",
        password: "11223344"
    });


    // called when the client connects
    function onConnect() {
        // Once a connection has been made, make a subscription and send a message.
        console.log("onConnect");
        client.subscribe("testtopic");
        message = new Paho.MQTT.Message("Hello");
        message.destinationName = "World";
        client.send(message);
    }

    // called when the client loses its connection
    function onConnectionLost(responseObject) {
        if (responseObject.errorCode !== 0) {
            
            console.log("onConnectionLost:" + responseObject.errorMessage);
        }
    }

    // called when a message arrives
    function onMessageArrived(message) {
        var obj = eval('(' + message.payloadString + ')');
        console.log(obj);
        document.getElementById('temp').innerHTML = obj.temp;
        document.getElementById('humi').innerHTML = obj.humi;
        console.log("onMessageArrived:" + message.payloadString);
    }
</script>

<!-- <script>
    //RabbitMQ的web-mqtt连接地址
    const url = 'ws://152.32.170.86:8083/mqtt';
    //获取订阅的topic
    const topic = getQueryString("topic");
    //连接到消息队列
    let client = mqtt.connect(url);
    client.on('connect', function() {
        //连接成功后订阅topic
        client.subscribe(topic, function(err) {
            if (!err) {
                showMessage("订阅topic：" + topic + "成功！");
            }
        });
    });
    //获取订阅topic中的消息
    client.on('message', function(topic, message) {
        showMessage("收到消息：" + message.toString());
    });

    //发送消息
    function sendMessage() {
        let targetTopic = document.getElementById("targetTopicInput").value;
        let message = document.getElementById("messageInput").value;
        //向目标topic中发送消息
        client.publish(targetTopic, message);
        showMessage("发送给" + targetTopic + "的消息：" + message);
    }

    //从URL中获取参数
    function getQueryString(name) {
        let reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
        let r = window.location.search.substr(1).match(reg);
        if (r != null) {
            return decodeURIComponent(r[2]);
        }
        return null;
    }

    //在消息列表中展示消息
    function showMessage(message) {
        let messageDiv = document.getElementById("messageDiv");
        let messageEle = document.createElement("div");
        messageEle.innerText = message;
        messageDiv.appendChild(messageEle);
    }

    //清空消息列表
    function clearMessage() {
        let messageDiv = document.getElementById("messageDiv");
        messageDiv.innerHTML = "";
    }
</script> -->

</html>