Create Table COVIDTestsByZip (
	ID						int NOT NULL AUTO_INCREMENT
,	ZipCode					varchar(5) not null
,	DateOfExtraction		datetime not null
,	TestedPositive			bigInt not null
,	Tested					bigInt not null
, PRIMARY KEY (ID)
)
