CREATE TABLE IF NOT EXISTS Address (
    [street] [varchar](50) NULL,
    [city] [varchar](50) NULL,
    [state] [varchar](50) NULL,
    [stateFull] [varchar](50) NULL,
    [zip] [varchar](50) NULL,
    [zip4] [varchar](50) NULL,
    [cityURL] [varchar](50) NULL,
    [zipURL] [varchar](50) NULL,
    [html] [varchar](50) NULL
);

CREATE TABLE IF NOT EXISTS District (
    [districtID] [varchar](50) NULL,
    [districtName] [varchar](50) NULL,
    [url] [varchar](50) NULL,
    [rankURL] [varchar](50) NULL
);

CREATE TABLE IF NOT EXISTS County (
    [countyName] [varchar](50) NULL,
    [countyURL] [varchar](50) NULL
);

CREATE TABLE IF NOT EXISTS RankHistory (
    [year] [int] ,
    [rank] [int] ,
    [rankOf] [int] ,
    [rankStars] [int] ,
    [rankLevel] [varchar](50) NULL,
    [rankStatewidePercentage] [decimal](9,2) ,
    [averageStandardScore] [decimal](9,2) 
);

CREATE TABLE IF NOT EXISTS School (
    [schoolid] [varchar](50) NULL,
    [schoolName] [varchar](50) NULL,
    [phone] [varchar](50) NULL,
    [url] [varchar](50) NULL,
    [urlCompare] [varchar](50) NULL,
    [address] Address,
    [lowGrade] [varchar](50) NULL,
    [highGrade] [varchar](50) NULL,
    [schoolLevel] [varchar](50) NULL,
    [isCharterSchool] [varchar](50) NULL,
    [isMagnetSchool] [varchar](50) NULL,
    [isVirtualSchool] [varchar](50) NULL,
    [isTitleISchool] [varchar](50) NULL,
    [isTitleISchoolwideSchool] [varchar](50) NULL,
    [district] District,
    [county] County,
    [rankHistory] RankHistory,
    [rankMovement] [int] ,
    [isPrivate] bit 
);