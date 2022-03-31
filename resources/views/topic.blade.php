<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Title</title>
</head>
<body>
<div>
	<label>目标Topic：<input id="targetTopicInput" type="text"></label><br>
	<label>发送消息：<input id="messageInput" type="text"></label><br>
	<button onclick="sendMessage()">发送</button>
	<button onclick="clearMessage()">清空</button>
	<div id="messageDiv"></div>
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
    client.on('connect', function () {
        //连接成功后订阅topic
        client.subscribe(topic, function (err) {
            if (!err) {
                showMessage("订阅topic：" + topic + "成功！");
            }
        });
    });
    //获取订阅topic中的消息
    client.on('message', function (topic, message) {
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