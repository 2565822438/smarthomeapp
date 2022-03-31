<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>智能家居控制系统</title>

</head>
<style>
    .home {
        background-color: antiquewhite;
        border-radius: 10%;
        width: 200px;
        height: 200px;
        padding: 20px;
        margin: 20px;
    }

    .home img {
        width: 100px;
    }

    .home button {
        height: 30px;
        width: 60px;
        border-radius: 5%;
    }
</style>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    <div class="home">
        <img src="./images/湿度.png" alt="湿度" />
        <p>温度：</p>
        <p>26℃</p>
    </div>
    <div class="home">
        <img src="./images/温度.png" alt="温度" />
        <p>湿度：</p>
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
        <button></button>
    </div>
    <div class="home">
        <img src="./images/风扇.png" alt="灯" />
        <p>风扇: <span>开</span></p>
        <button></button>
    </div>
    <div class="home">
        <img src="./images/窗户-关.png" alt="灯" />
        <p>窗户: <span>开</span></p>
        <button></button>
    </div>
    <div class="home">
        <img src="./images/门.png" alt="灯" />
        <p>门: <span>开</span></p>
        <button></button>
    </div>
    <div class="home">
        <img src="./images/安防模式.png" alt="灯" />
        <p>安防模式: <span>开</span></p>
        <button ></button>
    </div>
</body>
<script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
<script>
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
</script>

</html>