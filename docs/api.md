# PHPHub Api 接口说明

##基本参数使用说明

* `include`

使用 `include` 参数来引入关联的数据，多个关联使用 `,` 隔开。如获取帖子列表想要同时获取发布者
`https://api.phphub.org/topics?include=user`

* `filter`

使用 `filter` 应用查询过滤器，如要想获取推荐的帖子列表
`https://api.phphub.org/topics?filter=excellent`

* `per_page`

使用 `per_page` 参数设置分页每页显示数量，`{url}?per_page=30`
eg: `https://api.phphub.org/topics?per_page=30`

## Access Token

在使用 API 需要先申请应用。

接口： `POST` : `https://api.phphub.org/oauth/access_token`

### client_credentials 认证

无需用户身份即可获取，拥有部分接口的访问权限

__POST 参数__

| key | 值 |描述 |
|---|---|---|
|  grant\_type | client\_credentials | 指明认证类型 |
|  client\_id  | 传入 client\_id  | 申请 client\_id |
| client\_secret | 传入 client\_secret | 申请的 client\_secret | 


### login_token 认证

扫描用户的登陆二维码，解析后会获得用户名和用于登陆的token, `{username},{login_token}`,然后使用 username 和 login_token 获取 access_token

例：

```
summerblude,nWKEYFZ2wmSikRMjJ2Vl
```

__POST 参数__

| key | 值 |描述 |
|---|---|---|
|  grant\_type | login\_token | 指明认证类型 |
|  client\_id  | 传入 client\_id  | 申请 client\_id |
| client\_secret | 传入 client\_secret | 申请的 client\_secret | 
| username | 传入 username | 扫描获取的 username |
| login_token | 传入 user_token | 扫描获取的 user_token |

### 刷新 access_token

在 `access_token` 过期后可使用 `refresh_token` 重新申请新的 ``access_token``

__POST 参数__

| key | 值 |描述 |
|---|---|---|
|  grant\_type | refresh\_token | 指明此次请求为刷新 token |
|  client\_id  | 传入 client\_id  | 申请 client\_id |
| client\_secret | 传入 client\_secret | 申请的 client\_secret | 
| refresh\_token | 传入 refresh\_token | 获得的 refresh\_token | 

## 获取帖子列表

`GET` : `https://api.phphub.org/topics`

####可用 include
| 键  | 作用 | 实体 |
|---|---|---|
|  user | 帖子发表者 | User|
|  last\_reply\_user  | 帖子最后回复者  | User|

####可用 filter
| 键  | 作用 |
|---|---|
|  excellent | 推荐帖子 |
|  wiki  | wiki 帖子  |
|  recent  |  最新发布的帖子  |
|  vote  | 按照发布点赞数排序  |
|  nobody  | 无人问津  |

## 获取帖子详细页

`GET` : `https://api.phphub.org/topics/{id}`

####可用 include
| 键  | 作用 | 实体 |
|---|---|---|
|  user | 发表者 | User|
|  last\_reply\_user  | 帖子最后回复者  | User|
|  replies  | 帖子回复列表  | Reply|
|  replies.user  |  回复列表对应的发布者  |  User|

## 获取帖子下的评论

`GET` : `https://api.phphub.org/topics/{id}/replies`

####可用 include
| 键  | 作用 | 实体 |
|---|---|---|
|  user | 评论发布者| User


# Api 高级查询用法
## 指定查询的字段
如果默认返回的字段不够，可通过 `columns` 参数指定需要的字段
如:

`/topics?include=user,last_reply_user&columns(avatar,name),last_reply_user(avatar,name)`
