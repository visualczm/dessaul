
![image](https://www.timotion.com/styles/images/logo.png)

|項目名稱|製表人|文件版本|首次制訂日|修改日期
|:-:|-|:-:|-|-|
|PGE1Programmer開發文檔|T02321|V1.4|2018/11/30|2019/1/17|

---
## 目錄
[TOC]

## 開發環境
- Visual Studio 2013

## 運行環境
- Net Framework 4.0
-  Windows 7 Bit32 & Bit64

## 參考引用
>Dskin自定义的.NET皮肤界面库 项目地址:http://d.cskin.net/

### 開源項目
>Oxyplot图表 项目地址: https://github.com/oxyplot

>PdfSharp生成PDF 項目地址:https://github.com/empira/PDFsharp

>SharpConfig 读写配置文件 项目地址:https://github.com/cemdervis/SharpConfig

>SQLite 数据库 项目地址:https://sqlite.org/copyright.html

## 開發協議

### 控制盒&程式協議

>项目\DocumentHelp\通信協議\TS16150B通信協議-V1.5.docx

>项目\DocumentHelp\通信協議\N數據位-V5.20.xlsx

### 程式需求協議

>根据PM提出的需求进行制作

## 程序目錄結構


```
DocumentHelp    //幫助文檔
TCProgrammer    //項目目錄
    SourceCode  //控制盒源碼,每個型號對應一個源碼
        ControlBox
        TCS
        TH10
        TH12
        With display
        Without display
    Resources   //程序資源文件
    Products    //產品圖片
        Actuator    //馬達
        Control     //手控器
        Controlbox  //控制盒
        T-touch     //脚踏開關
    DataBase.db     //數據庫文件
    Version.txt     //版本記錄文件
    LICENSE.md      //授權文件
```



## 數據表結構

### Touch
| 字段 | 类型 | 注解 |
| ---- | ---- | ---- |
|Id|INTEGER ||
|Name|	TEXT| T-Touch顯示名稱
|ImgPath|TEXT|圖片路徑
Version|INTEGER|版本號

### Tcsync
| 字段 | 类型 | 注解 |
| ---- | ---- | ---- |
|Id|INTEGER ||
|Name|TEXT| Controlbox同步顯示名稱|
|DEC|TEXT| 十進制值<span style="color:f2f2f2;font-size:10px"> 寫入控制盒</span>|
|HEX|TEXT| 十六進制值|
|McuType|TEXT| Controlbox MCU型號|
Oscillator|TEXT| MCU容量|
|TcName|TEXT| 控制盒型號|
|ChoiesNumber|INTEGER| 馬達數量|
|SynType|TEXT| 同步類型<span style="color:f2f2f2;font-size:10px"> 備注使用</span>|
|ReMark|TEXT| 説明<span style="color:f2f2f2;font-size:10px"> 備注使用</span>|
|ImgPath|TEXT| 圖片路徑|
|HexPath|TEXT| 控制盒原代碼位置|
|Istouch|INTEGER|是否支持T-touch|
|IsShow|INTEGER| 是否顯示|
|IsTBB|INTEGER| 是否支持TBB|
|Defvoltage|TEXT| 默認電壓|
|Defcurrent|TEXT| 默認電流|

### TCS
| 字段 | 类型 | 注解 |
| ---- | ---- | ---- |
|Id|INTEGER |
|DEC|INTEGER|十進制值<span style="color:f2f2f2;font-size:10px"> 寫入控制盒</span>|
|HEX|TEXT|十進制值|
|Name|TEXT|型號|
|Oscillator|TEXT|晶振|
|HexPath|TEXT|原代碼路徑|

### Controlbox
| 字段 | 类型 | 注解 |
| ---- | ---- | ---- |
|Id|INTEGER ||
|Name|TEXT| 控制盒型號大類顯示 |
|ImgPath|TEXT|<span style="color:f2f2f2;font-size:10px"> 備用</span>|
|HexPath|TEXT|<span style="color:f2f2f2;font-size:10px"> 備用</span>|

### Control
| 字段 | 类型 | 注解 |
| ---- | ---- | ---- |
|Id|INTEGER |
|DEC|INTEGER|十進制值<span style="color:f2f2f2;font-size:10px"> 寫入設備</span>|
|HEX|INTEGER|十六進制|
|Name|TEXT|手控器大類顯示名稱|
|ImgPath|TEXT|圖片路徑|

### Columns
| 字段 | 类型 | 注解 |
| ---- | ---- | ---- |
|Id|INTEGER |
|ActuId|INTEGER| 關聯ID[Actuator]|
|Name|INTEGER|顯示名稱|
|ImgPath|TEXT|圖片路徑|
|Info|TEXT|備注|
|Sort|INTEGER|排序|


### Actuator
| 字段 | 类型 | 注解 |
| ---- | ---- | ---- |
|Id|INTEGER |
|Name|TEXT|馬達大類顯示名稱|

### Actlevel
| 字段 | 类型 | 注解 |
| ---- | ---- | ---- |
|Id|INTEGER |
|DEC|INTEGER|十進制值<span style="color:f2f2f2;font-size:10px"> 寫入設備</span>|
|HEX|INTEGER|十六進制值|
|ColumnsId|INTEGER|關聯ID[Columns]|
|Columns|TEXT|馬達二級參數類別|
|Types|TEXT|馬達三級參數類別|
|MotorType|TEXT|馬達大類名稱|
|Speed|TEXT|馬達轉速|
|Resolution|NUMERIC|馬達解析度|
|ColStarting|INTEGER|桌腳起始高度|
|ColEnding|INTEGER|桌角結束高度|

## 程序重點標注

>需要DSKIN加密狗進行開發

>引用Dskin.dll 及Dskin.Design

>控制盒出來的數據需要通過計算和查詢數據庫進行節目展示
<span style="color:f2f2f2;font-size:20px">算法有工程單位提供</span>

>詳細内容代碼中有進行標注

>DataAccess類重點説明

```
 /// <summary>
 /// 寫入控制盒頭
 /// </summary>
public static byte[] tcDataHead =
{ 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x10, 0x11,0x12, 0x13, 0x14, 0x15, 0x16, 0x17, 0x18,
0x19, 0x20, 0x21, 0x22, 0x23, 0x24, 0x25, 0x26, 0x27, 0x28, 0x29, 0x30 };

/// <summary>
/// 寫入TCS控制盒頭
/// </summary>
public static byte[] tcsDataHead = { 0xb1, 0xb2, 0xb3 };


/// <summary>
/// 保存TC HEX檔案的頭文件
/// </summary>
 public static string[] savehextcheader = new string[]
                        {   "50","51","52","53","54","55","56","57","58","59","5a","5b","5c","5d","5e","5f",
                            "60","61","62","63","64","65","66","67","68","69","6a","6b","6c","6d","6e","6f",
                            "70","71","72","73","74","75","76","77","78","79","7a","7b","7c","7d","7e","7f",
                            "80","81","82","83","84","85","86","87","88","89","8a","8b","8c","8d","8e","8f",
                            "90","91","92","93","94","95","96","97","98","99","9a","9b","9c","9d","9e","9f",
                            "a0","a1","a2","a3","a4","a5","a6","a7","a8","a9","aa","ab","ac","ad","ae","af",
                            "b0","b1","b2","b3","b4","b5","b6","b7","b8","b9","ba","bb","bc","bd","be","bf",
                            "c0","c1","c2","c3","c4","c5","c6","c7","c8","c9","ca"
                        };
/// <summary>
/// 保持TCS HEX檔案頭文件
/// </summary>
 public static string[] savehextcsheader = new string[]
 { "e0", "e1", "e2", "e3", "e4", "e5", "e6", "e7", "e8", "e9", "ea", "eb", "ec" };


以上根據此協議進行動態調整, DocumentHelp\通信協議\N數據位-V5.20.xlsx

/// <summary>
/// 固定值,計算電流值
/// </summary>
public const double MAD = 9.6256;


/// <summary>
/// 固定值,計算電壓值
/// </summary>
public const double PowerAD = 5.0693;

/// <summary>
/// 復位信號數
/// </summary>
public const UInt16 CountRest =0x10fe;


/// <summary>
/// 程序和控制盒的數據交換采用高低八位轉換
/// </summary>
public static class MConvert
{

        /// <summary>
        /// Int数值转换byte[2]高低位
        /// </summary>
        /// <param name="t"></param>
        /// <returns></returns>
        public static byte[] InttoArray(this int t)
        {
            var s = System.BitConverter.GetBytes(t);

            if (BitConverter.IsLittleEndian)
            {
                Array.Reverse(s);
            }
            return s.Skip(2).ToArray();
        }

        /// <summary>
        ///byte[2]高低位转换Int数值
        /// </summary>
        /// <param name="t"></param>
        /// <returns></returns>
        public static int ArraytoInt(this byte[] t)
        {

            if (BitConverter.IsLittleEndian)
            {
                Array.Reverse(t);
            }
           return  BitConverter.ToUInt16(t, 0);
        }

        public static string ToHexString(string str)
        {
            return int.Parse(str).ToString("X2");
        }


        public static string FromHexString(string hexString)
        {
            var bytes = new byte[hexString.Length / 2];
            for (var i = 0; i < bytes.Length; i++)
            {
                bytes[i] = Convert.ToByte(hexString.Substring(i * 2, 2), 16);
            }
            return Encoding.Unicode.GetString(bytes); // returns: "Hello world" for "48656C6C6F20776F726C64"
        }
}
```





