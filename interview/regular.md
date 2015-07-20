##正则

####反向引用

匿名反向引用
\b(\w+)\b\s+\1

命名反向引用

\b(?'group_name'\w+)\b\s+\k<group_name>\b
\b(?<Word>\w+)\b\s+\k<Word>\b

