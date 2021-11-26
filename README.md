# PHP7.4 搭建 GRPC 服务

> 本地系统：MacBook M1 arm64
> 为了下载软件方便，统一采用 Homebrew 安装软件

## M1 下安装 php7.4 开发环境

### 下载 php

```bash

# 使用 homebrew 搜索 php
brew search php

# 使用 homebrew 安装 php7.4
brew install php@7.4

# 安装之后的 php7.4 在 /opt/homebrew/etc/php/7.4/ 目录下

# 因为 mac 下默认已经安装了 php7.3 ，如果你想首先使用 php7.4 版本时，需要执行
echo 'export PATH="/opt/homebrew/opt/php@7.4/bin:$PATH"' >> ~/.zshrc
echo 'export PATH="/opt/homebrew/opt/php@7.4/sbin:$PATH"' >> ~/.zshrc
  
# 如果想要让编译器找到 php7.4 那么还需要设置
export LDFLAGS="-L/opt/homebrew/opt/php@7.4/lib"
export CPPFLAGS="-I/opt/homebrew/opt/php@7.4/include"

# 写入 .zshrc 文件之后，需要执行 source 命令，重新加载配置信息
source ~/.zshrc

# 可以使用 homebrew 来管理 php7.4 的服务状态，比如重启
brew services restart php@7.4

# 如果不需要守护进程运行 php7.4 时，可以执行
/opt/homebrew/opt/php@7.4/sbin/php-fpm --nodaemonize

```

### 安装 composer

```bash
brew install composer

# 查看 composer 是否安装成功
composer -V
```

## 安装 GRPC 扩展

- 安装 grpc 扩展

```bash
pecl install grpc

# 查看 grpc 扩展是否安装成功
php -m | grep grpc

```

- 安装 protobuf 扩展

```bash
pecl install protobuf

# 查看 protobuf 扩展是否安装成功
php -m | grep protobuf
```

如果提示报错，报错信息如下所示

```bash
/opt/homebrew/Cellar/php@7.4/7.4.25/include/php/ext/pcre/php_pcre.h:25:10: fatal error: 'pcre2.h' file not found
```

可以参考这条 [issue](https://github.com/swoole/swoole-src/issues/3926) 去解决

```bash
# 我这里使用的是 php7.4 版本
# pcre2 版本是 10.39
# 因此我这里需要执行如下命令即可，需要注意我这里使用的是 m1 ，intel 芯片的 Mac homebrew 安装 php 的路径和 m1 芯片的路径不一致，需要按照你自己的实际路径去建立软连接
ln -s /opt/homebrew/Cellar/pcre2/10.39/include/pcre2.h /opt/homebrew/Cellar/php@7.4/7.4.25/include/php/ext/pcre/pcre2.h
```

## 生成 php-plugins 插件

```bash

git clone -b v1.27.x https://github.com/grpc/grpc.git
# 如果速度慢的话，可以考虑 gitee 提供的镜像
git clone -b 1.27.x https://gitee.com/mirrors/grpc.git

# 安装 grpc 在 github 上的其他依赖
git submodule update --init

# 编译生成 grpc php 插件，生成 proto 文件时需要用到
# 执行成功之后会提示
# 比如我的生成之后提示了：[HOSTLD]  Linking /Users/pudongping/php-project/grpc/bins/opt/grpc_php_plugin
make grpc_php_plugin

# 生成的 grpc_php_plugin 插件在 `bins/opt/` 目录下
# 并且还会自动生成 protoc 文件，在 `/bins/opt/protobuf` 目录下
```

执行 `make grpc_php_plugin` 时， 如果提示错误如下：

```bash
[AUTOGEN] Preparing protobuf
Can't exec "aclocal": No such file or directory at /opt/homebrew/Cellar/autoconf/2.71/share/autoconf/Autom4te/FileUtils.pm line 274.
autoreconf: error: aclocal failed with exit status: 2
make: *** [third_party/protobuf/configure] Error 2
```

那么需要安装

```bash
brew install automake
```