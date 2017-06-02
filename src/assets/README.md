组织的Sass文件：
Base
base/文件夹包含了一些有关于你的项目中一些模板相关。在这里，
你可以看到reset样式(或者Normalize.css,或者其他)，也有一些关于文本排版方面的，
当然根据不同的项目会有一些其他的文件。
_reset.scss或_normalize.scss
_typography.scss


Helpers
   helpers/文件夹（有的地方也称其为utils/）主要包含了项目中关于Sass的工具和帮助之类。
   在里面放置了我们需要使用的_function.scss，和_mixin.scss。在这里还包含了一个_variables.scss文件
   （有的地方也称其为_config.scss），这里包含项目中所有的全局变量（比如排版本上的，配色方案等等）。
   _variables.scss
_mixin.scss
_function.scss
_placeholders.scss(也有称为_helpers.scss)



Layout
layout/文件夹(有时也称为partials/)中放置了大量的文件，每个文件主要用于布局方面的，
比如说"header"，“footer”等。他也会包括_grid.scss文件，用来创建网格系统。
_grid.scss
_header.scss
_footer.scss
_sidebar.scss
_forms.scss

Components
对于一些小组件，都放在了components/文件夹（通常也称为modules/），layout/是一个宏观的（定义全局的线框），
components/是一个微观的。它里面放了一些特定的组件，比如说slider，loading，widget或者其他的小组件。
通常components/目录下的都是一些小组件文件。
_media.scss
_carousel.scss
_thumbnails.scss

Page
如果你需要针对一些页面写特定的样式，我想将他们放在page/文件夹中是非常酷的，
并且以页面的名称来命名。例如，你的首页需要制作一个特定的样式.
_home.scss
 _contact.scss

Themes
 相关的文件放在这个文件夹中。这绝对跟具体的项目有关，你只要觉得跟主题相关的，有必要引入.
 _theme.scss
 _admin.scss

 Vendors
 创建vendors/文件夹，主要用来包含来自外部的库和框架的CSS文件。比如Bootstrap,jQueryUI，FancyCarouselSliderjQueryPowered等等。
