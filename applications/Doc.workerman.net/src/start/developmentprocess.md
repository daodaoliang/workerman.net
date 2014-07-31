# 开发流程


## 基本开发流程

1、和客户端协定请求协议

2、实现dealInput，使得dealInput能够识别你的协议，并且能够分辨出请求边界

3、实现dealProcess，使得请求完整到达时，能够进行相应的处理。


## 使用现有例子 ChatDemo

WorkerMan中有一个例子ChatDemo，这个例子虽然是个聊天的例子，但是适合很多长连接相关的应用，例如移动APP通讯、游戏服务器、与硬件通讯等等。

如果你的应用是需要长连接，并且需要向客户端推送数据，那么可以直接使用ChatDemo。

### ChatDemo开发流程

1、和客户端协定请求协议

2、根据协议实现ChatDemo/Event.php 中onGatewayMessage($recv_buffer)方法，用来判断请求边界，作用同dealInput($recv_buffer)。

3、实现ChatDemo/Event.php 中onConnect($recv_buffer)方法。当未验证的客户端发来消息触发，一般在这里验证客户端是否合法，合法的话进行客户端id与socket绑定（GateWay::notifyConnectionSuccess），则该socket再次发来消息时触发onMessage($uid, $recv_buffer)。这里也可以在判断客户端合法的情况下更新存储中客户端的在线状态等。


4、实现ChatDemo/Event.php 中的onMessage($uid, $recv_buffer)方法。当已经验证的客户端发来数据请求时触发，可以在这里做业务逻辑，比如向其他客户端发送消息(Gateway::sendToUid/sendToAll)


4、实现ChatDemo/Event.php 中的 onClose方法。当客户端主动断开连接时触发此方法。一般在这里做一些状态记录如下线和数据清理工作。