<?php
return array (
		//应用ID,您的APPID。
		'app_id' => "2016092500596210",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEpAIBAAKCAQEA5PfGHzyK32RKx7aFqawWcFtEJdHxR467UPMm8upP6R0yr/HXj67+BlhvdY1jaD65zA37kxc8w+31rD623BhoWkD/VHeoxgQbgJJgB2azF9Ng6jDQsCNvn9bsHPQ+6c1NW8cLJbHns1PSE4VKDdJ9ieCbtevWARcVwoyy/q7wk2H1lF4+lJfXTPpxs+h32mJjqZ+nQIhvgueYFmxwASU0HoLm7ds2a+vu5iaFepJfHkacuTqEWHefy2/TtGFD9wOFJwAK3K+f8Qj7hf2ve8J7tqzBQ4FJNXYsJQgtfqPFZHR7LFHTM6s74tUjs4ovuWCUDEINrwM4IdOgkRacwqW2RwIDAQABAoIBAA+5qKS6jrsa8zvWIEXv6Lacvghu68hDWEAOAw3J4+UZuUJ2NJzMouuipT0Ikdw1+qK2DyIiBW1baXUD9aEWGAyizCZr9W5sF8tzwh6gAgrP3KcY5SxDssXih+LRL4T1Mavs9qoHFuetCQ+IJvbeDvsqLueGo/L9N+Rdr2locGNexK8ukHeiBPm2Ufjist/9RMT81JE51TdYJG0MPPNQBw2sevXb/u7ELMQAcob2Mh+cIky+FzV4rvyP0rwZCOkMD1gZ49iq9QacYS3iuDU8n+hWgiEOZFY9NcyJReu3ej7AxfmVBiFw8kGdq9u7C4kczvlT2KwwfKor9fDdbEhRyIkCgYEA+QTvlguX7L2ey/+ehLgrD6LtepCnQBul+WyXtiNlL0RZWttH0ulfhmcyhfQ4MMiPVlsXC5+hvfEkc5tWu6YlBpYNZ8DP8Vbze6xkEsLVeaRsjKFIwNIxiOgLz/2veJgFlPUQ8SXSuJVRzJF9PbtcD3nuz2ZrKbum2YfqhQ7YjlsCgYEA62Lw3jcR9+JhaORPpqcgtIfT7W/8Ho7SYgXDGDFNcwnZ4mQyFdSdYklOg9pCr662bUcx+k+e21rYd+73QD/ARVbrs4OvIIyx68k5tqkRHcWr9aO6ExKzQoGTD7KVqPta5PHAMDuDVFkQI5SMRqwKFjlS9XrdDjDnNiAECxcpE4UCgYEAuz966NjO5LWxMrSD/kh+GMPqzr73BL3FkEiXy93RuDks96Tr3SyfJ/FxjEiX+BbXsZfNPHBMrwck4cls7q2AKfOrINlbg55eeCCpH3JiE5YQCa89hcCIfun99+hKiePGTrv4gVxvl1ywpaLBCipYj0qgyFO7QSZZ0DjjoCoJrQECgYAIqNQpqKb9kpN402VmwSE/4vtV8de5nBF7T7D0s+Oghs1AOeVpzi+YDRBZY28unWPSs1rQVZuHgFkUWHM6Jt5A7sivCvonXWWyQe3gnWmmyb3gxIw05Ww41yF841oEJHMclxQ18gqL0Nb6KB3c/7lDRgqaQ1Hcksn+wMDFU63MLQKBgQCCyh965zYCbC2NxFm7iGvzATX5Eq3qRWM/zf2ouaEeldAH3QNKwRm9gnMOqTu4pcNmYjA0gaKpf2OMWzoL7s0+qywpV6xZyt+b3Uzo612Hs85b8xH++WPbNflhdFivg4mhiM3moQEIW7+Ef0OEpDsW/fiNMuw5LDvtO3r55XgHyw==",
		
		//异步通知地址
		'notify_url' =>"http://shops/yi",
		
		//同步跳转
		'return_url' =>"http://shops/tong",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAsBTD4Bbfwv5dpg34qTxZUJW6tgRtHa6nA/CydQhzsN7VsrqOxijSpBLD8RplBMXDbqk36UsE1gxPIrDfHiizosgK+mvxMgse8k6JiVFKG4dTky1rDshrW8r9CBx5clClGBlf64Donx1ZDg5l1bNZh7bUn8BtwGkcR1KERp+6XQfk/fpiDXui8AbCebswgh3rCcTIgYFhjdk/CvpWueBG/1IdeuqFTH9pA5DD+q+6CAIaz8i07gpcgX9ON2kppxztQqBqWZEArDoTWSI7RmWuR9y70yeBpIauGuK87nEnCBZqXNGag3r1+mIWLWJfHSKRizyw4aDkJeLSw5CTN0egSQIDAQAB",

        //表示沙箱环境
       // 'mode'=>'dev'
	
);