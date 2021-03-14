DECLARE @XML XML = '<items>
    <totalitem>8</totalitem>
    <men>
        <tops>
            <top pid="1">
                <name>T1</name>
                <color>black</color>
                <description>T1 description is here</description>
                <origin>Hong Kong</origin>
                <photo>T1.jpg</photo>
                <price>50</price>
            </top>
            <top pid="2">
                <name>T3</name>
                <color>white</color>
                <description>T1 description is here</description>
                <origin>Hong Kong</origin>
                <photo>T3.jpg</photo>
                <price>50</price>
            </top>
            <top pid="3">
                <name>T4</name>
                <color>white</color>
                <description>T1 description is here</description>
                <origin>Hong Kong</origin>
                <photo>T4.jpg</photo>
                <price>50</price>
            </top>
            <top pid="4">
                <name>T5</name>
                <color>grey</color>
                <description>T1 description is here</description>
                <origin>Hong Kong</origin>
                <photo>T5.jpg</photo>
                <price>50</price>
            </top>
            <top pid="5">
                <name>T6</name>
                <color>white</color>
                <description>T1 description is here</description>
                <origin>Hong Kong</origin>
                <photo>T6.jpg</photo>
                <price>50</price>
            </top>
        </tops>
        <pants>
            <pant pid="6">
                <name>P1</name>
                <color>black</color>
                <description>T1 description is here</description>
                <origin>Hong Kong</origin>
                <photo>P1.jpg</photo>
                <price>60</price>
            </pant>
        </pants>
    </men>
    <women>
        <tops>
            <top pid="7">
                <name>T2</name>
                <color>pink</color>
                <description>T2 description is here</description>
                <origin>USA</origin>
                <photo>T2.jpg</photo>
                <price>80</price>
            </top>
        </tops>
        <pants>
            <pant pid="8">
                <name>P2</name>
                <color>white</color>
                <description>T2 description is here</description>
                <origin>Hong Kong</origin>
                <photo>P2.jpg</photo>
                <price>60</price>
            </pant>
        </pants>
    </women>
</items>'

SELECT
    pid = top.value('@pid', 'int'),
    name = top.value('@name', 'varchar(20)'),
    color = top.value('@color', 'varchar(20)'),
    description = top.value('@description', 'varchar(40)'),
    origin = top.value('@origin', 'varchar(20)'),
    photo = Events.value('@photo', 'varchar(20)'),
    price =Events.value('price', 'int'),
    
FROM
 @XML.nodes('/items') AS XTbl(Events)