# PHPHub Api 接口说明

##基本参数使用说明

* `include` 引入关联数据
使用 `include` 参数来引入关联的数据，如获取帖子列表想要同时获取发布者，可通过添加 `{url}?include` 来引入，引入多个关联使用 `,` 隔开。
eg: `https://api.phphub.org/topics?include=user`

* `filter` 应用过滤器
使用 `filter` 在数据上应用过滤器，如要想获取推荐的帖子列表，可添加 `{url}?filter=excellent`
eg: `https://api.phphub.org/topics?filter=excellent`

* `per_page` 设置每页数量
使用 `per_page` 参数设置分页每页显示数量，`{url}?per_page=30`
eg: `https://api.phphub.org/topics?per_page=30`


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
