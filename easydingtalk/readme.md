
**应用中 权限管理开通 接口的权限**

**登陆回调 到前端地址**


## 安装
```
顺序安装
composer require symfony/cache 

composer require pimple/pimple

composer require overtrue/http

修改Client.php 增加 方法

/**
 * JSON request.
 *
 * @param string       $url
 * @param string|array $data
 * @param array        $query
 *
 * @throws \GuzzleHttp\Exception\GuzzleException
 *
 * @return \Psr\Http\Message\ResponseInterface|\Overtrue\Http\Support\Collection|array|object|string
 */
public function postJson(string $url, array $data = [], array $query = [])
{
    return $this->request($url, 'POST', ['query' => $query, 'json' => $data]);
}


composer.json 中新增

"autoload": {
        "classmap": [
            "vendor/dingtalk"
        ],
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        },
        "files": [
            "app/Helpers/functions.php",
            "vendor/dingtalk/src/helpers.php"
        ]
    },


```


`composer info symfony/cache` 看看什么信息？

找不到postJson()这个方法

Call to undefined method EasyDingTalk\Kernel\Http\Client::postJson()



Overtrue\Http\Client

```
    /**
     * JSON request.
     *
     * @param string       $url
     * @param string|array $data
     * @param array        $query
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return \Psr\Http\Message\ResponseInterface|\Overtrue\Http\Support\Collection|array|object|string
     */
    public function postJson(string $url, array $data = [], array $query = [])
    {
        return $this->request($url, 'POST', ['query' => $query, 'json' => $data]);
    }
```

dingtalk/src/User/Client

```
/**
     * 根据 Unionid 获取 Userid
     *
     * @param string $unionid
     *
     * @return mixed
     */
    public function getUseridByUnionid($unionid)
    {
        //return $this->client->get('user/getUseridByUnionid', compact('unionid'));
        return $this->client->post('topapi/user/getbyunionid', compact('unionid'));

    }
```

# 手动添加第三方vendor类，laravel自动加载



如果拓展包第三方没有提供 `composer` 安装方法，手动将其放在vendor目录下，那么，就需要手动添加需要自动加载的目录或者文件。
在 `composer.json` 文件里的 `autoload` 的 `classmap` 里加上第三方包的文件夹路径，如果是单独自动加载某个文件，则将其放在 `files` 里面。
例如："vendor/alibabacloud"

```
"autoload": {
    "classmap": [
        "vendor/adbario",
        "vendor/alibabacloud"
    ],
    "psr-4": {
        "App\\": "app/"
    },
    "files":[
        "app/Common/functions.php",
        "vendor/alibabacloud/client/src/Functions.php"
    ]
},
```






