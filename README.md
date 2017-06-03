# emeter
A smart energy meter using the Wi-Fi mesh protocol.

The current smart energy meters used either have built-in GPRS/GSM based connectivity to
the internet or use Zigbee, a wireless ad hoc network. The problem with the former is that the
running costs of such meters are very high overtime as the supply company or the customer
ends up paying the network operator for providing internet connectivity. While the use of
Zigbee eliminates this problem, Zigbee typically has lesser range when compared to Wi-Fi.
Hence, by using a Wi-Fi mesh network, we can eliminate this drawback and reduce the
risk of connectivity failures.

The main aim of this project is to design and implement a smart energy meter with
AMR (Automatic Meter Reading) capability using a Wi-Fi mesh to reduce the number of
internet connections required and also eliminate the need of a built-in memory to store the
energy meter reading. The project also aims to reduce the risk of transformer overloading by
cutting off power to individual homes if they consume more power than a pre-specified limit.
