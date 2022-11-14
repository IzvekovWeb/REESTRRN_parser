--
-- PostgreSQL database dump
--

-- Dumped from database version 14.5
-- Dumped by pg_dump version 14.5

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: news; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.news (
    title character varying(255),
    link character varying(255),
    description text,
    site_link character varying(255),
    id integer NOT NULL,
    "time" date
);


ALTER TABLE public.news OWNER TO postgres;

--
-- Name: news_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.news_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.news_id_seq OWNER TO postgres;

--
-- Name: news_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.news_id_seq OWNED BY public.news.id;


--
-- Name: news_test; Type: TABLE; Schema: public; Owner: izvekov
--

CREATE TABLE public.news_test (
    title character varying(255),
    link character varying(255),
    description text,
    site_link character varying(255),
    id integer NOT NULL,
    "time" date
);


ALTER TABLE public.news_test OWNER TO izvekov;

--
-- Name: news_test_id_seq; Type: SEQUENCE; Schema: public; Owner: izvekov
--

CREATE SEQUENCE public.news_test_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.news_test_id_seq OWNER TO izvekov;

--
-- Name: news_test_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: izvekov
--

ALTER SEQUENCE public.news_test_id_seq OWNED BY public.news_test.id;


--
-- Name: news id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.news ALTER COLUMN id SET DEFAULT nextval('public.news_id_seq'::regclass);


--
-- Name: news_test id; Type: DEFAULT; Schema: public; Owner: izvekov
--

ALTER TABLE ONLY public.news_test ALTER COLUMN id SET DEFAULT nextval('public.news_test_id_seq'::regclass);


--
-- Data for Name: news; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.news (title, link, description, site_link, id, "time") FROM stdin;
АО «Реестр» приняло решения о регистрации выпуска акций учредительских эмиссий	aoreestr.ru/press/news/ao-reestr-prinyalo-resheniya-o-registratsii-vypuska-aktsiy-uchreditelskikh-emissiy-26-10-22/		https://aoreestr.ru/press	319	2022-10-26
АО «Реестр» с 17 по 23 октября приступило к ведению реестров следующих эмитентов	aoreestr.ru		https://aoreestr.ru/press	320	2022-10-25
Правовой режим «казначейских» акций. Приобретение АО собственных акций	aoreestr.ru/press/publications/pravovoy-rezhim-kaznacheyskikh-aktsiy-priobretenie-ao-sobstvennykh-aktsiy/		https://aoreestr.ru/press	321	2022-10-21
АО «Реестр» с 10 по 16 октября приступило к ведению реестров следующих эмитентов	aoreestr.ru		https://aoreestr.ru/press	322	2022-10-18
АО «Реестр» приняло решения о регистрации выпуска акций учредительских эмиссий	aoreestr.ru/press/news/ao-reestr-prinyalo-resheniya-o-registratsii-vypuska-aktsiy-uchreditelskikh-emissiy-12-10-22/		https://aoreestr.ru/press	323	2022-10-12
АО «Реестр» с 3 по 9 октября приступило к ведению реестров следующих эмитентов	aoreestr.ru		https://aoreestr.ru/press	324	2022-10-11
Новый механизм приобретения собственных акций ПАО	aoreestr.ru/press/news/novyy-mekhanizm-priobreteniya-sobstvennykh-aktsiy-pao/		https://aoreestr.ru/press	325	2022-10-07
АО «Реестр» с 26 сентября по 2 октября приступило к ведению реестров следующих эмитентов	aoreestr.ru		https://aoreestr.ru/press	326	2022-10-04
АО «Реестр» приняло решения о регистрации выпуска акций учредительских эмиссий	aoreestr.ru/press/news/ao-reestr-prinyalo-resheniya-o-registratsii-vypuska-aktsiy-uchreditelskikh-emissiy-28-09-22/		https://aoreestr.ru/press	327	2022-09-28
Прейскурант на услуги регистратора АО "ВРК".	https://www.vrk.ru/news/item/596/	С 31.11.2022г. вступил в действие новый Прейскурант на услуги регистратора АО "ВРК".	https://www.vrk.ru/news	328	2022-10-31
Новости обслуживания	https://www.vrk.ru/news/item/595/	26.10.2022 принят на обслуживание эмитент ЗАО "РОЩИНО".	https://www.vrk.ru/news	329	2022-10-27
Размещен Расчет собственных средств на 30.09.2022	https://www.vrk.ru/news/item/594/	Размещен Расчет собственных средств на 30.09.2022	https://www.vrk.ru/news	330	2022-10-26
Утвержден новый Прейскурант на услуги регистратора АО "ВРК"	https://www.vrk.ru/news/item/593/		https://www.vrk.ru/news	331	2022-10-25
Новости обслуживания	https://www.vrk.ru/news/item/592/	20.10.2022 приняты на обслуживание четыре эмитента.	https://www.vrk.ru/news	332	2022-10-21
Работа доп. офиса в г. Екатеринбург	https://www.vrk.ru/news/item/591/		https://www.vrk.ru/news	333	2022-10-12
Прейскурант на услуги регистратора АО "ВРК"	https://www.vrk.ru/news/item/589/	С 06.10.2022г. вступил в действие новый Прейскурант на услуги регистратора АО "ВРК".	https://www.vrk.ru/news	334	2022-10-06
Утвержден новый Прейскурант на услуги регистратора АО "ВРК"	https://www.vrk.ru/news/item/588/	Утвержден новый Прейскурант на услуги регистратора АО "ВРК" действует с 06.10.2022.	https://www.vrk.ru/news	335	2022-10-04
Вступила в действие новая редакция Правил ведения реестров.	https://www.vrk.ru/news/item/590/		https://www.vrk.ru/news	336	2022-10-04
Размещен Расчет собственных средств на 31.08.2022	https://www.vrk.ru/news/item/587/	Размещен Расчет собственных средств на 31.08.2022	https://www.vrk.ru/news	337	2022-09-30
На нашем сайте в разделе «О Компании»/ «Раскрытие информации» опубликован Расчет размера собственных средств АО «МРЦ» на 30.09.2022 г.	http://mrz.ru/company/news/		http://mrz.ru/company/news/	338	2022-10-27
На нашем сайте в разделе «О Компании»/ «Раскрытие информации» опубликован Расчет размера собственных средств АО «МРЦ» на 31.07.2022 г.	http://mrz.ru/company/news/		http://mrz.ru/company/news/	339	2022-08-29
На нашем сайте в разделе «О Компании»/ «Раскрытие информации» опубликован Расчет размера собственных средств АО «МРЦ» на 30.06.2022 г.	http://mrz.ru/company/news/		http://mrz.ru/company/news/	340	2022-07-29
На нашем сайте в разделе «О Компании»/ «Раскрытие информации»/ «Бухгалтерская (Финансовая) отчетность» опубликована Промежуточная бухгалтерская (финансовая) отчетность за 1 полугодие 2022 г.	http://mrz.ru/company/news/		http://mrz.ru/company/news/	341	2022-07-29
На нашем сайте в разделе «О Компании»/ «Раскрытие информации» опубликован Расчет размера собственных средств АО «МРЦ» на 31.05.2022 г.	http://mrz.ru/company/news/		http://mrz.ru/company/news/	342	2022-06-29
На нашем сайте в разделе «О Компании»/ «Раскрытие информации» опубликован Расчет размера собственных средств АО «МРЦ» на 30.04.2022 г.	http://mrz.ru/company/news/		http://mrz.ru/company/news/	343	2022-05-30
На нашем сайте в разделе «О Компании»/ «Раскрытие информации»/ «Бухгалтерская (Финансовая) отчетность» опубликована Промежуточная бухгалтерская (финансовая) отчетность за 1 квартал 2022 г.	http://mrz.ru/company/news/		http://mrz.ru/company/news/	344	2022-05-04
На нашем сайте в разделе «О Компании»/ «Раскрытие информации» опубликован Расчет размера собственных средств АО «МРЦ» на 31.03.2022 г.	http://mrz.ru/company/news/		http://mrz.ru/company/news/	345	2022-05-04
Уважаемые клиенты! Информируем вас, что при проблемах с доступом к сайту и онлайн-сервисам необходимо установить браузеры, которые поддерживают российский сертификат безопасности. Такая функциональность есть у Яндекс.Браузера и браузера "Атом".	http://mrz.ru/company/news/		http://mrz.ru/company/news/	346	2022-04-08
На нашем сайте в разделе «О Компании»/ «Раскрытие информации» опубликован Расчет размера собственных средств АО «МРЦ» на 28.02.2022 г.	http://mrz.ru/company/news/		http://mrz.ru/company/news/	347	2022-03-30
На нашем сайте в разделе «О Компании»/ «Раскрытие информации» опубликован Расчет размера собственных средств АО «МРЦ» на 31.01.2022 г.	http://mrz.ru/company/news/		http://mrz.ru/company/news/	348	2022-02-28
На нашем сайте в разделе «О Компании»/ «Раскрытие информации» опубликован Расчет размера собственных средств АО «МРЦ» на 31.12.2021 г.	http://mrz.ru/company/news/		http://mrz.ru/company/news/	349	2022-01-31
С 25.01.2022 г. трансфер-агент ООО «Оборонрегистр» прекращает прием акционеров АО «МРЦ» в пункте приема трансфер-агента г. Великие Луки Псковской обл. в связи с расторжением договора об оказании трансфер-агентских услуг.	http://mrz.ru/company/news/		http://mrz.ru/company/news/	350	2022-01-19
ООО «НРК Фондовый рынок» преобразовано в акционерное общество	rrost.ru/ru/press/events/2022/2022-09-30/	Завершена процедура реорганизации ООО «НРК Фондовый Рынок», входящего в группу НРК - Р.О.С.Т., в форме преобразования в Акционерное общество «НРК Фондовый Рынок». Соответствующая запись в Единый реестр регистрации юридических лиц внесена 29 сентября 2022 года.…	https://rrost.ru/ru/press/events/	351	2022-09-30
НРК - Р.О.С.Т меняет уполномоченный орган по оценке информационной безопасности	rrost.ru/ru/press/events/2022/2022-08-26/		https://rrost.ru/ru/press/events/	352	2022-08-26
Подтверждена работа Р.О.С.Т. Директора  в российской операционной системе  Astra Linux Special Edition	rrost.ru/ru/press/events/2022/2022-08-08/	Система электронного голосования коллегиальных органов общества Р.О.С.Т. Директор успешно прошла проверку на совместимость с сертифицированной российской операционной системой специального назначения со встроенными средствами защиты информации Astra Linux Special Edition (SE). Ранее, в апреле этого…	https://rrost.ru/ru/press/events/	353	2022-08-08
Следующие шаги корпоративного управления: НРК - Р.О.С.Т. на форуме НОКС	rrost.ru/ru/press/events/2022/2022-07-11/	7-8 июля 2022 года в Москве прошло традиционное   мероприятие в отрасли корпоративного управления – XVI Форум Национального объединения корпоративных секретарей (НОКС).\nВ мероприятии, проведенном в очно-заочном формате, приняло участие около 50 спикеров - признанных экспертов в теории и практике …	https://rrost.ru/ru/press/events/	354	2022-07-11
НРК - Р.О.С.Т. запустила сервис онлайн-закрытия лицевого счета в реестре ПИФ	rrost.ru/ru/press/events/2022/2022-07-08/		https://rrost.ru/ru/press/events/	355	2022-07-08
НРК - Р.О.С.Т. информирует об изменениях в составе Совета директоров компании	rrost.ru/ru/press/events/2022/2022-06-30/	Иван Тырышкин принял решение выйти из состава Совета директоров НРК - Р.О.С.Т.	https://rrost.ru/ru/press/events/	356	2022-06-30
В НРК - Р.О.С.Т. состоялся разговор на паях	rrost.ru/ru/press/events/2022/2022-05-26/	25 мая 2022 года в студии НРК - Р.О.С.Т. в прямом эфире прошла вторая встреча проекта «Спроси эксперта», посвященная вопросам ведения бизнеса с применением закрытых паевых инвестиционных фондов (ЗПИФ).…	https://rrost.ru/ru/press/events/	357	2022-05-26
Упрощен механизм доказательства достоверности электронного голосования на собраниях акционеров	rrost.ru/ru/press/events/2022/2022-05-20/		https://rrost.ru/ru/press/events/	358	2022-05-20
АО «Новый регистратор» осуществил регистрацию выпуска акций	https://www.newreg.ru/news/ao-novyj-registrator-osushhestvil-registraciju-vypuska-akcij-220/	31.10.2022\nАО «Новый регистратор» 31.10.2022 принято решение о регистрации выпуска обыкновенных акций Акционерного общества «Гранд-М» (Российская Федерация, город Краснодар), размещенных путем распределения акций среди учредителей акционерного общества. Выпуску ценных бумаг присвоен регистрационный номер 1-01-03701-G.	https://www.newreg.ru/news/	359	2022-10-31
АО «Новый регистратор» осуществил регистрацию выпусков акций	https://www.newreg.ru/news/ao-novyj-registrator-osushhestvil-registraciju-vypuskov-akcij-18/	27.10.2022\nАО «Новый регистратор» 27.10.2022 принято решение о регистрации выпусков обыкновенных акций:\nАкционерного общества «Лучшее решение» (Российская Федерация, город Москва), размещенных путем приобретения акций единственным учредителем акционерного общества. Выпуску ценных бумаг присвоен регистрационный номер 1-01-03687-G;\nАкционерного общества «Орион...	https://www.newreg.ru/news/	360	2022-10-27
АО «Новый регистратор» осуществил регистрацию выпусков акций	https://www.newreg.ru/news/ao-novyj-registrator-osushhestvil-registraciju-vypuskov-akcij-17/	24.10.2022\nАО «Новый регистратор» 24.10.2022 принято решение о регистрации выпуска обыкновенных акций Акционерного общества «УПРАВЛЕНИЕ ЭНЕРГОАКТИВАМИ» (Российская Федерация, город Москва), размещенных путем приобретения акций единственным учредителем акционерного общества. Выпуску ценных бумаг присвоен регистрационный номер 1-01-03672-G.	https://www.newreg.ru/news/	361	2022-10-24
АО «Новый регистратор» осуществил регистрацию выпусков акций	https://www.newreg.ru/news/ao-novyj-registrator-osushhestvil-registraciju-vypuskov-akcij-16/	19.10.2022\nАО «Новый регистратор» 19.10.2022 принято решение о регистрации выпусков обыкновенных акций:\nАкционерного общества «Транс Капитал» (Российская Федерация, город Москва), размещенных путем приобретения акций единственным учредителем акционерного общества. Выпуску ценных бумаг присвоен регистрационный номер 1-01-03658-G;\nАкционерного общества «Стилдон»...	https://www.newreg.ru/news/	362	2022-10-19
АО «Новый регистратор» осуществил регистрацию выпусков акций	https://www.newreg.ru/news/ao-novyj-registrator-osushhestvil-registraciju-vypuskov-akcij-15/	13.10.2022\nАО «Новый регистратор» 13.10.2022 принято решение о регистрации выпуска обыкновенных акций Акционерного общества СТРОИТЕЛЬНЫЙ КОНЦЕРН «РУСПРОЕКТСНАБ» (Российская Федерация, город Москва), размещенных путем приобретения акций единственным учредителем акционерного общества. Выпуску ценных бумаг присвоен регистрационный номер 1-01-03632-G.	https://www.newreg.ru/news/	363	2022-10-13
АО «Новый регистратор» осуществил регистрацию выпусков акций	https://www.newreg.ru/news/ao-novyj-registrator-osushhestvil-registraciju-vypuskov-akcij-14/	12.10.2022\nАО «Новый регистратор» 12.10.2022 принято решение о регистрации выпусков обыкновенных акций:\nАкционерного общества «Соранс» (Российская Федерация, Новосибирская область, город Новосибирск), размещенных путем приобретения акций единственным учредителем акционерного общества. Выпуску ценных бумаг присвоен регистрационный номер...	https://www.newreg.ru/news/	364	2022-10-12
АО «Новый регистратор» осуществил регистрацию выпусков акций	https://www.newreg.ru/news/ao-novyj-registrator-osushhestvil-registraciju-vypuskov-akcij-13/	12.10.2022\nАО «Новый регистратор» 11.10.2022 принято решение о регистрации выпуска обыкновенных акций Акционерного общества «АКВАСТРОЙГРУПП» (Российская Федерация, город Москва), размещенных путем                приобретения акций единственным учредителем акционерного общества. Выпуску ценных бумаг присвоен регистрационный номер 1-01-03623-G.	https://www.newreg.ru/news/	365	2022-10-12
АО «Новый регистратор» осуществил регистрацию выпусков акций	https://www.newreg.ru/news/ao-novyj-registrator-osushhestvil-registraciju-vypuskov-akcij-12/	07.10.2022\nАО «Новый регистратор» 07.10.2022 принято решение о регистрации выпуска обыкновенных акций Акционерного общества «Спасский Хуторок» (Российская Федерация, Рязанская область, с. Половское),      размещаемых путем распределения акций среди учредителей акционерного общества. Выпуску ценных бумаг      присвоен регистрационный номер 1-01-03612-G.	https://www.newreg.ru/news/	366	2022-10-07
АО «Новый регистратор» осуществил регистрацию выпусков акций	https://www.newreg.ru/news/ao-novyj-registrator-osushhestvil-registraciju-vypuskov-akcij-11/	06.10.2022\nАО «Новый регистратор» 06.10.2022 принято решение о регистрации выпуска обыкновенных акций Акционерного общества СТРОИТЕЛЬНЫЙ КОНЦЕРН «РОСПРОЕКТСНАБ» (Российская Федерация, город Москва), размещенных путем приобретения акций единственным учредителем акционерного общества. Выпуску ценных бумаг присвоен регистрационный номер 1-01-03596-G.	https://www.newreg.ru/news/	367	2022-10-06
АО «Новый регистратор» осуществил регистрацию выпусков акций	https://www.newreg.ru/news/ao-novyj-registrator-osushhestvil-registraciju-vypuskov-akcij-10/	05.10.2022\nАО «Новый регистратор» 05.10.2022 принято решение о регистрации выпуска обыкновенных акций Акционерного общества «Вэбер» (Российская Федерация, город Приозерск), размещенных путем приобретения акций единственным учредителем акционерного общества. Выпуску ценных бумаг присвоен регистрационный номер 1-01-03593-G.	https://www.newreg.ru/news/	368	2022-10-05
Новость: "Правительство расширило перечень недружественных иностранных государств и территорий"	profrc.ru/company/news/2414		https://profrc.ru/company/news/news-our/year/2022/	369	2022-10-31
Новость: "Официальные разъяснения N 1 по вопросам применения Указа Президента Российской Федерации от 8 сентября 2022 г. N 618"	profrc.ru/company/news/2412		https://profrc.ru/company/news/news-our/year/2022/	370	2022-10-18
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Смарт Бизнес»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-smart-biznes/		https://rostatus.ru/about/news/	432	2022-10-18
Новость: "Актуализирован предусмотренный законом о ПОД/ФТ порядок применения мер по замораживанию (блокированию) денежных средств или иного имущества"	profrc.ru/company/news/2410		https://profrc.ru/company/news/news-our/year/2022/	371	2022-10-11
Новость: "Расширен перечень иностранных юридических лиц, в отношении которых применяются специальные экономические меры"	profrc.ru/company/news/2409		https://profrc.ru/company/news/news-our/year/2022/	372	2022-10-10
Статья: "Крупная сделка"	profrc.ru/company/news/2407		https://profrc.ru/company/news/news-our/year/2022/	373	2022-10-07
Новость: "Продлены ограничения на переводы за рубеж средств нерезидентов из недружественных стран со счетов брокеров и доверительных управляющих"	profrc.ru/company/news/2403		https://profrc.ru/company/news/news-our/year/2022/	374	2022-09-30
Новость: "О получении информации о контролируемых иностранных лицах"	profrc.ru/company/news/2402		https://profrc.ru/company/news/news-our/year/2022/	375	2022-09-27
Новость: "Об утверждении рекомендуемой формы заявления об осуществлении прав акционера в отношении российского хозяйственного общества, акционером которого является контролируемая иностранная компания"	profrc.ru/company/news/2400		https://profrc.ru/company/news/news-our/year/2022/	376	2022-09-23
Новость: "Банк России разъяснил некоторые вопросы, касающиеся применения указов о мерах, направленных на обеспечение финансовой стабильности"	profrc.ru/company/news/2401		https://profrc.ru/company/news/news-our/year/2022/	377	2022-09-23
Статья: "Дополнительная эмиссия акций"	profrc.ru/company/news/2397		https://profrc.ru/company/news/news-our/year/2022/	378	2022-09-16
Информация для клиентов и контрагентов	https://paritet.ru/informacziya-dlya-klientov-i-kontragentov/	Уважаемые клиенты и контрагенты, Информируем Вас, что в случае проблем с доступом к сайтам и […]	https://paritet.ru/all-news/	379	2022-03-31
Регистрация выпуска при учреждении	https://paritet.ru/registracziya-vypuska-pri-uchrezhdenii-186/	АО «РДЦ ПАРИТЕТ» 27.10.2022г. приняло решение о регистрации выпуска обыкновенных акций Акционерного общества «Парус» (г. […]	https://paritet.ru/all-news/	380	2022-10-27
Регистрация выпуска при учреждении	https://paritet.ru/registracziya-vypuska-pri-uchrezhdenii-185/	АО «РДЦ ПАРИТЕТ» 26.10.2022г. приняло решение о регистрации выпуска обыкновенных акций Акционерного общества «Русское слово» […]	https://paritet.ru/all-news/	381	2022-10-26
Регистрация выпуска при учреждении	https://paritet.ru/registracziya-vypuska-pri-uchrezhdenii-184/	АО «РДЦ ПАРИТЕТ» 26.10.2022г. приняло решение о регистрации выпуска обыкновенных акций Акционерного общества «Скитские песни» […]	https://paritet.ru/all-news/	382	2022-10-26
Принят реестр владельцев ценных бумаг	https://paritet.ru/prinyat-reestr-vladelczev-czennyh-bumag-165/	Принят на обслуживание реестр владельцев ценных бумаг: Акционерное общество «Промышленная Группа «Метран»	https://paritet.ru/all-news/	383	2022-10-25
Принят реестр владельцев ценных бумаг	https://paritet.ru/prinyat-reestr-vladelczev-czennyh-bumag-164/	Принят на обслуживание реестр владельцев ценных бумаг: акционерное общество «БурСервис»	https://paritet.ru/all-news/	384	2022-10-24
Принят реестр владельцев ценных бумаг	https://paritet.ru/prinyat-reestr-vladelczev-czennyh-bumag-163/	Принят на обслуживание реестр владельцев ценных бумаг: Акционерное общество Финансово-производственная компания «Зевс»	https://paritet.ru/all-news/	385	2022-10-19
Принят реестр владельцев ценных бумаг	https://paritet.ru/prinyat-reestr-vladelczev-czennyh-bumag-162/	Принят на обслуживание реестр владельцев ценных бумаг: Акционерное общество «Норд Консалт»	https://paritet.ru/all-news/	386	2022-10-12
Регистрация выпуска при учреждении	https://paritet.ru/registracziya-vypuska-pri-uchrezhdenii-183/	АО «РДЦ ПАРИТЕТ» 10.10.2022г. приняло решение о регистрации выпуска обыкновенных акций Акционерного общества «Специализированный застройщик […]	https://paritet.ru/all-news/	387	2022-10-10
Регистрация выпуска при учреждении	https://paritet.ru/registracziya-vypuska-pri-uchrezhdenii-182/	АО «РДЦ ПАРИТЕТ» 10.10.2022г. приняло решение о регистрации выпуска обыкновенных акций Акционерного общества Финансово-производственная компания […]	https://paritet.ru/all-news/	388	2022-10-10
Принят реестр владельцев ценных бумаг	https://paritet.ru/prinyat-reestr-vladelczev-czennyh-bumag-161/	Принят на обслуживание реестр владельцев ценных бумаг: Акционерное общество «Кругозор»	https://paritet.ru/all-news/	389	2022-10-05
Принят реестр владельцев ценных бумаг	https://paritet.ru/prinyat-reestr-vladelczev-czennyh-bumag-160/	Принят на обслуживание реестр владельцев ценных бумаг: Акционерное общество «КОМФОРТ-СП»	https://paritet.ru/all-news/	390	2022-10-04
Приняты реестры владельцев ценных бумаг	https://paritet.ru/prinyaty-reestry-vladelczev-czennyh-bumag-30/	Приняты на обслуживание реестры владельцев ценных бумаг: Акционерное общество «Станиславский» и Акционерное общество «Лайт»	https://paritet.ru/all-news/	391	2022-10-03
Регистрация выпуска при учреждении	https://paritet.ru/registracziya-vypuska-pri-uchrezhdenii-181/	АО «РДЦ ПАРИТЕТ» 03.10.2022г. приняло решение о регистрации выпуска обыкновенных акций Акционерного общества Финансово-производственая компания […]	https://paritet.ru/all-news/	392	2022-10-03
Принят реестр владельцев ценных бумаг	https://paritet.ru/prinyat-reestr-vladelczev-czennyh-bumag-159/	Принят на обслуживание реестр владельцев ценных бумаг: Акционерное общество «Дукат»	https://paritet.ru/all-news/	393	2022-09-30
Принят реестр владельцев ценных бумаг	https://paritet.ru/prinyat-reestr-vladelczev-czennyh-bumag-158/	Принят на обслуживание реестр владельцев ценных бумаг: Акционерное общество Научно Производственное объединение «Прометей»	https://paritet.ru/all-news/	394	2022-09-29
Регистрация выпуска при учреждении	https://paritet.ru/registracziya-vypuska-pri-uchrezhdenii-180/	АО «РДЦ ПАРИТЕТ» 29.09.2022г. приняло решение о регистрации выпуска обыкновенных акций Акционерного общества «БурСервис» (г. […]	https://paritet.ru/all-news/	395	2022-09-29
Регистрация выпуска при учреждении	https://paritet.ru/registracziya-vypuska-pri-uchrezhdenii-179/	АО «РДЦ ПАРИТЕТ» 27.09.2022г. приняло решение о регистрации выпуска обыкновенных акций Акционерного общества Группа компаний […]	https://paritet.ru/all-news/	396	2022-09-27
Приняты реестры владельцев ценных бумаг	https://paritet.ru/prinyaty-reestry-vladelczev-czennyh-bumag-29/	Приняты на обслуживание реестры владельцев ценных бумаг: Акционерное общество «Контракт холдинг» и Акционерное общество «Толот […]	https://paritet.ru/all-news/	397	2022-09-26
Принят реестр владельцев ценных бумаг	https://paritet.ru/prinyat-reestr-vladelczev-czennyh-bumag-157/	Принят на обслуживание реестр владельцев ценных бумаг: Акционерное общество «Альфа»	https://paritet.ru/all-news/	398	2022-09-22
Регистрация выпуска при учреждении	https://paritet.ru/registracziya-vypuska-pri-uchrezhdenii-178/	АО «РДЦ ПАРИТЕТ» 21.09.2022г. приняло решение о регистрации выпуска обыкновенных акций Акционерного общества «Дукат» (г. […]	https://paritet.ru/all-news/	399	2022-09-21
Добавлен Расчет собственных средств на 30.09.2022 г.	rtreg.ru/posts/news-28-10-22	Добавлен Расчет собственных средств на 30.09.2022 г.	https://rtreg.ru/posts	400	1970-01-01
Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов	rtreg.ru/posts/news-24-10-22	Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов.	https://rtreg.ru/posts	401	1970-01-01
Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов	rtreg.ru/posts/news2-18-10-22	Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов.	https://rtreg.ru/posts	402	1970-01-01
Обновлена информация, подлежащая обязательному раскрытию, в отношении перечня трансфер-агентов	rtreg.ru/posts/news-18-10-22	Обновлена информация, подлежащая обязательному раскрытию, в отношении перечня трансфер-агентов.	https://rtreg.ru/posts	403	1970-01-01
Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов	rtreg.ru/posts/news-17-10-22	Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов.	https://rtreg.ru/posts	404	1970-01-01
Обновлена информация, подлежащая обязательному раскрытию, в отношении ПЕРЕЧНЯ ЭМИТЕНТОВ ВЫПОЛНЯЮЩИХ ПО ДОГОВОРУ ФУНКЦИИ РЕГИСТРАТОРА	rtreg.ru/posts/news-11-10-22	Обновлена информация, подлежащая обязательному раскрытию, в отношении перечня эмитентов выполняющих по договору функции регистратора.	https://rtreg.ru/posts	405	1970-01-01
Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов	rtreg.ru/posts/news-07-10-22	Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов.	https://rtreg.ru/posts	406	1970-01-01
Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов	rtreg.ru/posts/news-05-10-22	Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов.	https://rtreg.ru/posts	407	1970-01-01
Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов	rtreg.ru/posts/news-04-10-22	Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов.	https://rtreg.ru/posts	408	1970-01-01
Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов	rtreg.ru/posts/news-03-10-22	Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов.	https://rtreg.ru/posts	409	1970-01-01
28.10.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекращен договор с: АО "Егорьевский пиво-безалкогольный завод" ИНН 5011000509, ОГРН 1035002355882 в связи с ликвидацией общества\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1451		https://regkrc.ru/news/	410	2022-10-28
26.10.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекращен договор с: ОАО "ЦСГ" ИНН 7743809073, ОГРН 1117746124550 в связи с ликвидацией общества\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1452		https://regkrc.ru/news/	411	2022-10-26
25.10.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекратили хранить реестр: ЗАО ППФ "РОДИНА" ИНН 2335008196, ОГРН 1022304012576 в связи с истечением срока хранения\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1453		https://regkrc.ru/news/	412	2022-10-25
24.10.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекращен договор по инициативе Эмитента с АО "ЦТК" ИНН 7709221179, ОГРН 1027739524229 и передан реестр регистратору АО ВТБ Регистратор\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1454		https://regkrc.ru/news/	413	2022-10-24
14.10.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекращен договор с: АО "Труженик моря" ИНН 2352033450, ОГРН 1022304746188 в связи с ликвидацией общества\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1446		https://regkrc.ru/news/	414	2022-10-14
13.10.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tАО «КРЦ» 13.10.2022 принято решение о регистрации выпуска ценных бумаг: акций обыкновенных Акционерного общества «Сельскохозяйственное Предприятие «Родина» (Российская Федерация, Республика Крым, ...\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1445		https://regkrc.ru/news/	415	2022-10-13
13.10.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекращен договор с: ОАО ПМК-19 "КС" ИНН 2313003469, ОГРН 1022302294541 в связи с ликвидацией общества\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1444		https://regkrc.ru/news/	416	2022-10-13
11.10.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекращен договор с: ЗАО "Кубаньагрострой-3" ИНН 0106002270, ОГРН 1020100822972 в связи с ликвидацией общества\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1443		https://regkrc.ru/news/	417	2022-10-11
11.10.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекратили хранить реестр: ПАО "КПК" ИНН 9102025787, ОГРН 1149102042000 в связи с истечением срока хранения\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1442		https://regkrc.ru/news/	418	2022-10-11
10.10.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекращен договор с: ПАО "Геленджик-Банк" ИНН 2304032625, ОГРН 1022300003186 в одностороннем порядке по инициативе Эмитента без указания им наименования следующего держателя реестра\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1441		https://regkrc.ru/news/	419	2022-10-10
06.10.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекращен договор с: ОАО "ММВЗ" ИНН 7729096222, ОГРН 1027700365802 в связи с ликвидацией общества\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1437		https://regkrc.ru/news/	420	2022-10-06
06.10.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекращен договор с: АО "Краснодарстрой" ИНН 2309033679, ОГРН 1022301172046 в одностороннем порядке по инициативе Эмитента без указания им наименования следующего держателя реестра\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1436		https://regkrc.ru/news/	421	2022-10-06
05.10.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекратили хранить реестр: ЗАО "ОРЭЙ" ИНН 2318014351, ОГРН 1022302789893 в связи с истечением срока хранения\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1435		https://regkrc.ru/news/	422	2022-10-05
30.09.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекращен договор с: АО "Дельта Солар" ИНН 9102067787, ОГРН 1159102003829 в связи с ликвидацией общества\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1428		https://regkrc.ru/news/	423	2022-09-30
29.09.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекратили хранить реестр: ОАО "ЖДК" ИНН 7743905034, ОГРН 1137746993361 в связи с истечением срока хранения\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1429		https://regkrc.ru/news/	424	2022-09-29
28.09.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекратили хранить реестр: ЗАО "Едоша Краснодар" ИНН 2311163996, ОГРН 1132311012514 в связи с истечением срока хранения\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1430		https://regkrc.ru/news/	425	2022-09-28
26.09.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекратили хранить реестр: АО "ЗАРЯ" ИНН 2351004086, ОГРН 1022304717555 в связи с истечением срока хранения\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1431		https://regkrc.ru/news/	426	2022-09-26
22.09.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекратили хранить реестр: АО «Южный Ресурс» ИНН 7704684688, ОГРН 1087746460284 в связи с истечением срока хранения\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1426		https://regkrc.ru/news/	427	2022-09-22
19.09.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекратили хранить реестр: АО «СОЛИГРАН» ИНН 7743510050, ОГРН 1037739911395 в связи с истечением срока хранения\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1427		https://regkrc.ru/news/	428	2022-09-19
05.09.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекращен договор по инициативе Эмитента с АО "КППС" ИНН 9204509184, ОГРН 1149204070531 и передан реестр регистратору АО "Сервис-Реестр"\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1425		https://regkrc.ru/news/	429	2022-09-05
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Квазар»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-kvazar/		https://rostatus.ru/about/news/	430	2022-10-18
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «ПРОТОН»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-proton/		https://rostatus.ru/about/news/	431	2022-10-18
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Новые трубы»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-novye-truby/		https://rostatus.ru/about/news/	433	2022-10-14
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Восточная Торговая Компания»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-vostochnaya-torgovaya%21/		https://rostatus.ru/about/news/	434	2022-10-12
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Восточная Торговая Компания»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-vostochnaya-torgovaya/		https://rostatus.ru/about/news/	435	2022-10-12
Дайджест законодательных изменений	rostatus.ru/about/news/daydzhest-zakonodatelnykh-izmeneniy/		https://rostatus.ru/about/news/	436	2022-10-07
Информация о режиме работы ОП в г. Чита в октябре 2022 года	rostatus.ru/about/news/informatsiya-o-rezhime-raboty-op-v-g-chita-v-oktyabre-2022-goda/		https://rostatus.ru/about/news/	437	2022-10-06
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «ДЮМИ»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-torgovo-promyshlenna%21/		https://rostatus.ru/about/news/	438	2022-10-03
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Торгово-промышленная компания «ТИТАН»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-torgovo-promyshlenna/		https://rostatus.ru/about/news/	439	2022-09-30
Информация о режиме работы ОП в г. Южно-Сахалинск в октябре 2022 года	rostatus.ru/about/news/informatsiya-o-rezhime-raboty-op-v-g-yuzhno-sakhalinsk-v-oktyabre-2022-goda/		https://rostatus.ru/about/news/	440	2022-09-29
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Сайбер Икс»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-sayber-iks/		https://rostatus.ru/about/news/	441	2022-09-27
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «ТИТУЛ»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-titul/		https://rostatus.ru/about/news/	442	2022-09-22
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Эко-отель «Пятница Дзен. Телецкое»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-eko-otel-pyatnitsa-d%21/		https://rostatus.ru/about/news/	443	2022-09-21
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Диадема»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-diadema/		https://rostatus.ru/about/news/	444	2022-09-21
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Циркон»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-tsirkon/		https://rostatus.ru/about/news/	445	2022-09-20
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Берилл»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-berill/		https://rostatus.ru/about/news/	446	2022-09-20
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Проспектус»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-prospektus/		https://rostatus.ru/about/news/	447	2022-09-20
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «РусПромТех»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-ruspromtekh%21/		https://rostatus.ru/about/news/	448	2022-09-19
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «РусПромТех»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-ruspromtekh/		https://rostatus.ru/about/news/	449	2022-09-19
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Аверс»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-avers/		https://rostatus.ru/about/news/	450	2022-09-16
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества МЕТАЛЛОЦЕХ	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-metallotsekh/		https://rostatus.ru/about/news/	451	2022-09-16
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «ШАРКОН»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-sharkon/		https://rostatus.ru/about/news/	452	2022-09-15
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «ТУРА Капитал»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-tura-kapital/		https://rostatus.ru/about/news/	453	2022-09-13
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «ОПАЛ»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-opal/		https://rostatus.ru/about/news/	454	2022-09-12
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Тритон»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-triton%21/		https://rostatus.ru/about/news/	455	2022-09-12
Принят на обслуживание реестр акционеров ЗАО "Дворец на Английской"	industria-reestr.ru/novosti/4359.html		https://www.industria-reestr.ru/novosti/	543	1970-01-01
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «МАРКЕТ ПАРТНЕРС»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-market-partners/		https://rostatus.ru/about/news/	456	2022-09-09
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Кристал»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-kristal/		https://rostatus.ru/about/news/	457	2022-09-09
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «ИНРОСТА»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-inrosta/		https://rostatus.ru/about/news/	458	2022-09-06
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Милитех»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-militekh/		https://rostatus.ru/about/news/	459	2022-09-06
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Орбита»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-orbita/		https://rostatus.ru/about/news/	460	2022-09-02
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Иннополис Девелопмент»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-innopolis-developmen/		https://rostatus.ru/about/news/	461	2022-09-02
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «ТАЙМИНВЕСТ»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-tayminvest/		https://rostatus.ru/about/news/	462	2022-08-31
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Эко-отель «Пятница.Дзен»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-eko-otel-pyatnitsa-d_%21/		https://rostatus.ru/about/news/	463	2022-08-26
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Эко-отель «Пятница.Дзен»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-eko-otel-pyatnitsa-d/		https://rostatus.ru/about/news/	464	2022-08-26
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Астра»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-astra/		https://rostatus.ru/about/news/	465	2022-08-24
Перечень документов, необходимых для подтверждения права на льготное налогообложение дивидендов по акциям ПАО «Газпром» по результатам деятельности в…	https://draga.ru/novosti/novosti-kompanii/perechen-dokumentov-neobhodimyh-dlja-podtverzhdenija-prava-na-lgotnoe-nalogooblozhenie-dividendov-po-akcijam-pao-gazprom-po-rezultatam-dejatelnosti-v-pervom-polugodii-2022-goda/	По доходам в виде дивидендов по акциям, принадлежащим иностранным юридическим лицам, имеющим лицевые счета в учетной системе регистратора: В целях...	https://draga.ru/topics/novosti/	466	2022-10-12
Дайджест новостей правового регулирования за 3 квартал 2022 года.	https://draga.ru/novosti/novosti-zakon/dajdzhest-novostej-pravovogo-regulirovanija-za-3-kvartal-2022-goda/	Представляем Вашему вниманию нормативные акты, официально опубликованные и/или вступившие в силу в 3 квартале 2022 года, в нашем Дайджесте новостей...	https://draga.ru/topics/novosti/	467	2022-10-05
Cостоялось внеочередное Общее собрание акционеров ПАО «Газпром»	https://draga.ru/novosti/novosti-kompanii/costojalos-vneocherednoe-obshhee-sobranie-akcionerov-pao-gazprom/	30 сентября 2022 года состоялось внеочередное Общее собрание акционеров ПАО «Газпром». По решению Совета директоров ПАО «Газпром» собрание проводилось в...	https://draga.ru/topics/novosti/	468	2022-10-04
Вниманию акционеров АО «Центргаз».	https://draga.ru/novosti/message-issuers/vnimaniju-akcionerov-ao-centrgaz/	Информация по процедуре выкупа акций эмитентом: Памятка акционерам;Требование о выкупе акций;Требования об отзыве выкупа акций;Информация по вопросам налогообложения физ. лица;Информация...	https://draga.ru/topics/novosti/	469	2022-09-21
Вниманию акционеров ПАО «Уралхиммаш».	https://draga.ru/novosti/message-issuers/vnimaniju-akcionerov-pao-uralhimmash-3/	Информация по процедуре выкупа акций эмитентом: Памятка акционерам;Рекомендуемая форма требования о выкупе акций ОА;Рекомендуемая форма требования о выкупе акций ПА;Рекомендуемая...	https://draga.ru/topics/novosti/	470	2022-09-19
АО «ДРАГА» вошло в ТОП-3 лидеров регистраторского бизнеса.	https://draga.ru/novosti/novosti-kompanii/ao-draga-voshlo-v-top-3-liderov-registratorskogo-biznesa/	Регистратор «ДРАГА» вошел в ТОП-3 лидеров регистраторского бизнеса по результатам национального рейтингового исследования регистраторов за 2021 год, занимая третью строчку рейтинга. Также АО...	https://draga.ru/topics/novosti/	471	2022-09-14
О наградах Совета финансового рынка.	https://draga.ru/novosti/novosti-kompanii/o-nagradah-soveta-finansovogo-rynka/	В канун празднования Дня финансиста на основании решения Совета финансового рынка и по представлению Совета директоров ПАРТАД  генеральный директор АО...	https://draga.ru/topics/novosti/	472	2022-09-13
Принят на обслуживание реестр акционеров АО "Союзцветметавтоматика"	industria-reestr.ru/novosti/4357.html		https://www.industria-reestr.ru/novosti/	544	1970-01-01
АО «ДРАГА» поздравляет работников нефтяной и газовой промышленности!	https://draga.ru/novosti/novosti-kompanii/ao-draga-pozdravljaet-rabotnikov-neftjanoj-i-gazovoj-promyshlennosti-6/	АО «ДРАГА» поздравляет работников нефтяной и газовой промышленности с профессиональным праздником! Нефтегазовый комплекс занимает ключевое место в отечественной экономике, формирует...	https://draga.ru/topics/novosti/	473	2022-09-01
Конференция «Корпоративное право 2022» пройдет 28 октября.	https://draga.ru/novosti/novosti-kompanii/konferencija-korporativnoe-pravo-2022-projdet-28-oktjabrja/	Конференция «Корпоративное право 2022» пройдет 28 октября 2022 года в Марриотт Москва Ройал Аврора. Организатор конференции «Корпоративное право»: Журнал «Акционерное...	https://draga.ru/topics/novosti/	474	2022-08-29
О режиме работы филиала АО «ДРАГА» в г. Казани 30 августа 2022 года.	https://draga.ru/novosti/novosti-kompanii/o-rezhime-raboty-filiala-ao-draga-v-g-kazani-30-avgusta-2022-goda/	Уважаемые клиенты! Информируем вас о том, что в связи с нерабочим праздничным днем на территории Республики Татарстан — День Республики...	https://draga.ru/topics/novosti/	475	2022-08-26
Выплата дивидендов	aoreestr.ru/press/publications/vyplata-dividendov/		https://aoreestr.ru/press	476	2022-11-02
АО «Реестр» с 24 по 30 октября приступило к ведению реестров следующих эмитентов	aoreestr.ru		https://aoreestr.ru/press	477	2022-11-01
Принят реестр владельцев ценных бумаг	https://paritet.ru/prinyat-reestr-vladelczev-czennyh-bumag-166/	Принят на обслуживание реестр владельцев ценных бумаг: Акционерное общество «Норд Траст»	https://paritet.ru/all-news/	478	2022-10-31
28.02.2022\nУважаемые клиенты АО «Агентство «РНР»!\r\nДоводим до вашего сведения, что...	https://www.a-rnr.ru/news/	28.02.2022\nУважаемые клиенты АО «Агентство «РНР»!\r\nДоводим до вашего сведения, что Федеральным законом от 25.02.2022 № 25-ФЗ «О внесении изменений в Федеральный закон «Об акционерных обществах» и о приостановлении действия отдельных положений законодательных актов Российской Федерации» (статьи 2 и 3) установлено, что общие собрания акционеров, на которых...	https://www.a-rnr.ru/news/	479	2022-02-28
27.04.2021\nС 26 апреля 2021 года вступили изменения в Федеральный закон от 8 августа 2001...	https://www.a-rnr.ru/news/	27.04.2021\nС 26 апреля 2021 года вступили изменения в Федеральный закон от 8 августа 2001 года № 129-ФЗ "О государственной регистрации юридических лиц и индивидуальных предпринимателей", в соответствии с которыми в едином государственном реестре юридических лиц должны содержаться в отношении акционерного общества сведения о том, что общество состоит из...	https://www.a-rnr.ru/news/	480	2021-04-27
26.02.2021\nВ соответствии с Федеральным законом "Об акционерных обществах" вопросы: об...	https://www.a-rnr.ru/news/	26.02.2021\nВ соответствии с Федеральным законом "Об акционерных обществах" вопросы: об избрании совета директоров (наблюдательного совета) общества, ревизионной комиссии общества, утверждении аудитора общества, утверждение годового отчета, годовой бухгалтерской (финансовой) отчетности общества, если уставом общества решение этих вопросов не отнесено к...	https://www.a-rnr.ru/news/	481	2021-02-26
21.02.2021\n25 лет - со дня образования АО "Агентство "РНР".	https://www.a-rnr.ru/news/	21.02.2021\n25 лет - со дня образования АО "Агентство "РНР".	https://www.a-rnr.ru/news/	482	2021-02-21
18.02.2021\nС 1 октября 2021 года вступает в силу Положение ЦБ Российской Федерации от...	https://www.a-rnr.ru/news/	18.02.2021\nС 1 октября 2021 года вступает в силу Положение ЦБ Российской Федерации от 11.01.2021 г. № 751-П "О перечне информации, связанной с осуществлением прав по эмиссионным ценным бумагам, предоставляемой эмитентами центральному депозитарию, порядке и сроках ее предоставления, а также о требованиях к порядку предоставления центральным депозитарием доступа к...	https://www.a-rnr.ru/news/	483	2021-02-18
О режиме работы с 3 по 7 ноября 2022 года	reggarant.ru/index.php/ru/novosti-kompanii/1117-3-7-11-2022		https://www.reggarant.ru/index.php/ru/novosti-kompanii	484	1970-01-01
Регистратор «Гарант» вошел в ТОП 10 Национального рейтинга регистраторов по итогам 2021 года	reggarant.ru/index.php/ru/novosti-kompanii/1116-partad-rating-top10-2021		https://www.reggarant.ru/index.php/ru/novosti-kompanii	485	1970-01-01
Регистратор «Гарант» представляет новую услугу «Регистрация дополнительных выпус ...	reggarant.ru/index.php/ru/novosti-kompanii/1115-invest-platforma-news		https://www.reggarant.ru/index.php/ru/novosti-kompanii	486	1970-01-01
Об изменении адреса Пункта приема (выдачи) документов трансфер-агента в городе Урай	reggarant.ru/index.php/ru/novosti-kompanii/1113-ta-uray-new		https://www.reggarant.ru/index.php/ru/novosti-kompanii	487	1970-01-01
Регистратор «Гарант» в полной мере выполняет требования законодательства РФ в об ...	reggarant.ru/index.php/ru/novosti-kompanii/1111-reggarant-pers-dannye		https://www.reggarant.ru/index.php/ru/novosti-kompanii	488	1970-01-01
Регистратор «Гарант» принял участие в ежегодной конференция ПАРТАД – «Инфраструк ...	reggarant.ru/index.php/ru/novosti-kompanii/1110-partad-07-2022		https://www.reggarant.ru/index.php/ru/novosti-kompanii	489	1970-01-01
О режиме работы с 10 по 14 июня 2022 года	reggarant.ru/index.php/ru/novosti-kompanii/1109-10-14-06-2022		https://www.reggarant.ru/index.php/ru/novosti-kompanii	490	1970-01-01
О вступлении в силу новой редакции Правил доступа в личный кабинет акционера и и ...	reggarant.ru/index.php/ru/novosti-kompanii/1108-rules-lka-evoting-2022		https://www.reggarant.ru/index.php/ru/novosti-kompanii	491	1970-01-01
С Днем Победы!	reggarant.ru/index.php/ru/novosti-kompanii/1107-09-05-2022		https://www.reggarant.ru/index.php/ru/novosti-kompanii	492	1970-01-01
Предоставление согласия общества для передачи в Росстат сведений об АО и его акционерах-юрлицах	reggarant.ru/index.php/ru/novosti-kompanii/1106-ao-rosstat-2022		https://www.reggarant.ru/index.php/ru/novosti-kompanii	493	1970-01-01
Приглашаем принять участие в тестовой эксплуатации видеоконференции «VISUM»	zao-srk.ru/novosti/novosti/6245.html		https://zao-srk.ru/novosti/	494	1970-01-01
Принят новый эмитент открытое акционерное общество  «Алтайавтотрансобслуживание»	zao-srk.ru/novosti/vedenie-reestrov/6244.html		https://zao-srk.ru/novosti/	495	1970-01-01
Принят новый эмитент акционерное общество «КОНСТАНТА КАПИТАЛ»	zao-srk.ru/novosti/vedenie-reestrov/6243.html		https://zao-srk.ru/novosti/	496	1970-01-01
Возобновлено ведение реестра Акционерное общество «ТЕНРОСИБ»	zao-srk.ru/novosti/vedenie-reestrov/6228.html		https://zao-srk.ru/novosti/	497	1970-01-01
Принят новый эмитент акционерное общество  «Новосибирский нефтехимический комплекс»	zao-srk.ru/novosti/vedenie-reestrov/6222.html		https://zao-srk.ru/novosti/	498	1970-01-01
АО «СРК» ОСУЩЕСТВИЛО РЕГИСТРАЦИЮ ВЫПУСКА ЦЕННЫХ БУМАГ АО «ННХК»	zao-srk.ru/novosti/zaregistrirovannye-vypuski-tsb/6206.html		https://zao-srk.ru/novosti/	499	1970-01-01
Принят новый эмитент акционерное общество  «Запсибвтормет»	zao-srk.ru/novosti/vedenie-reestrov/6195.html		https://zao-srk.ru/novosti/	500	1970-01-01
Принят новый эмитент акционерное общество  «Альтернатива»	zao-srk.ru/novosti/vedenie-reestrov/6188.html		https://zao-srk.ru/novosti/	501	1970-01-01
Принят новый эмитент закрытое акционерное общество "ГРИС"	zao-srk.ru/novosti/vedenie-reestrov/6177.html		https://zao-srk.ru/novosti/	502	1970-01-01
Штормы интеллектуальных морей	zao-srk.ru/novosti/novosti/6176.html		https://zao-srk.ru/novosti/	503	1970-01-01
Принят новый эмитент акционерное общество  «Регионстрой»	zao-srk.ru/novosti/vedenie-reestrov/6174.html		https://zao-srk.ru/novosti/	504	1970-01-01
Принят новый эмитент акционерное общество  «Развитие»	zao-srk.ru/novosti/vedenie-reestrov/6173.html		https://zao-srk.ru/novosti/	505	1970-01-01
Обязательное предложение о покупке акций  АО «Дорожное»	intraco.ruo-kompanii/sobyitiya/news/obyazatelnoe-predlozhenie-o-pokupke-akczij-ao-«dorozhnoe».html		https://intraco.ru/o-kompanii/sobyitiya/news/	506	2022-08-25
Информация для получателей финансовых услуг	intraco.ruo-kompanii/sobyitiya/news/informacziya-dlya-poluchatelej-finansovyix-uslug.html		https://intraco.ru/o-kompanii/sobyitiya/news/	507	2022-07-19
Требование акционера - владельца голосующих акций о выкупе Обществом всех или части принадлежащих ему акций АО «Холдинговая компания Элинар»	intraco.ruo-kompanii/sobyitiya/news/trebovanie-akczionera-vladelcza-golosuyushhix-akczij-o-vyikupe-obshhestvom-vsex-ili-chasti-prinadlezhashhix-emu-akczij-ao-«xoldingovaya-kompaniya-elinar».html		https://intraco.ru/o-kompanii/sobyitiya/news/	508	2022-06-30
Требование акционера - владельца голосующих акций о выкупе Обществом всех или части принадлежащих ему акций ПАО "Метафракс Кемикалс"	intraco.ruo-kompanii/sobyitiya/news/trebovanie-akczionera-vladelcza-golosuyushhix-akczij-o-vyikupe-obshhestvom-vsex-ili-chasti-prinadlezhashhix-emu-akczij-pao-metafraks-kemikals.html		https://intraco.ru/o-kompanii/sobyitiya/news/	509	2022-06-28
Требование акционера - владельца голосующих акций о выкупе Обществом всех или части принадлежащих ему акций ПАО "Метафракс Кемикалс"	intraco.ruo-kompanii/sobyitiya/news/trebovanie-akczionera-vladelcza-golosuyushhix-akczij-o-vyikupe-obshhestvom-vsex-ili-chasti-prinadlezhashhix-emu-akczij-pao-metafraks-kemikals-2022.html		https://intraco.ru/o-kompanii/sobyitiya/news/	510	2022-02-18
Требование о выкупе эмиссионных ценных бумаг ПАО «Пермгражданпроект»	intraco.ruo-kompanii/sobyitiya/news/trebovanie-o-vyikupe-emissionnyix-czennyix-bumag-pao-«permgrazhdanproekt»-2021.html		https://intraco.ru/o-kompanii/sobyitiya/news/	511	2021-11-08
Для акционеров ПАО «ИФ «Защита» - информация о приобретении в соответствии со ст.72 Федерального закона «Об акционерных обществах» размещенных акций ПАО «ИФ «Защита»	intraco.ruo-kompanii/sobyitiya/news/dlya-akczionerov-pao-«if-«zashhita»-informacziya-o-priobretenii-2021.html		https://intraco.ru/o-kompanii/sobyitiya/news/	512	2021-06-11
Для акционеров ПАО «Челябинский трубопрокатный завод» - информация об Обязательном предложении о выкупе акций в соответствии с требованиями ст. 84.2 Федерального закона «Об акционерных обществах»	intraco.ruo-kompanii/sobyitiya/news/obyazatelnoe-predlozhenie-pao-chtpz-2021.html		https://intraco.ru/o-kompanii/sobyitiya/news/	513	2021-04-29
Принят на обслуживание реестр акционеров ОАО "Автодормехбаза" Юго-Восточного административного округа города Москвы	industria-reestr.ru/novosti/4360.html		https://www.industria-reestr.ru/novosti/	542	1970-01-01
Требование акционера - владельца акций о выкупе ценных бумаг ПАО «Производственное объединение «Горизонт» в соответствии с требованиями статьи 84.8 Федерального закона «Об акционерных обществах»	intraco.ruo-kompanii/sobyitiya/news/trebovanie-akczionera-vladelcza-akczij-o-vyikupe-czennyix-bumag-pao-«proizvodstvennoe-obedinenie-«gorizont»-v-sootvetstvii-s-trebovaniyami-stati-84.8-federalnogo-zakona-«ob-akczionernyix-obshhestvax».html		https://intraco.ru/o-kompanii/sobyitiya/news/	514	2021-03-30
АО «Регистратор Интрако» провел консультационный онлайн-семинар по вопросам изменений в области корпоративного законодательства	intraco.ruo-kompanii/sobyitiya/news/ao-«registrator-intrako»-provel-konsultaczionnyij-onlajn-seminar-po-voprosam-izmenenij-v-oblasti-korporativnogo-zakonodatelstva.html		https://intraco.ru/o-kompanii/sobyitiya/news/	515	2021-03-29
О внесении изменений в правила регистрации выпуска акций при учреждении акционерного общества	https://sineft.ru/news/o-vnesenii-izmeneniy-v-pravila-registratsii-vypusk/		https://sineft.ru/news/	516	2022-10-12
Начато ведение реестра владельцев ценных бумаг акционерного общества «Мясокомбинат Ялуторовский»	https://sineft.ru/news/nachato-vedenie-reestra-vladeltsev-tsennykh-bumag-288/		https://sineft.ru/news/	517	2022-09-07
Начато ведение реестра владельцев ценных бумаг акционерного общества «Производственное Геофизическое Объединение «Тюменьпромгеофизика»	https://sineft.ru/news/nachato-vedenie-reestra-vladeltsev-tsennykh-bumag-285/		https://sineft.ru/news/	518	2022-06-07
О внесении изменений в формы документов	https://sineft.ru/news/o-vnesenii-izmeneniy-v-formy-dokumentov284/		https://sineft.ru/news/	519	2022-05-04
Начато ведение реестра владельцев ценных бумаг акционерного общества «ОстаОйл»	https://sineft.ru/news/nachato-vedenie-reestra-vladeltsev-tsennykh-bumag-282/		https://sineft.ru/news/	520	2022-04-27
Удостоверение решения единственного акционера	https://sineft.ru/news/udostoverenie-resheniya-edinstvennogo-aktsionera/		https://sineft.ru/news/	521	2022-04-05
Эмитентам! Новое в законодательстве по созыву ГОСА в 2022 году	https://sineft.ru/news/sovet-direktorov-v-2022-g-obyazan-naznachit-novuyu/		https://sineft.ru/news/	522	2022-03-23
О внесении изменений в правила ведения реестра	https://sineft.ru/news/o-vnesenii-izmeneniy-v-pravila-vedeniya-reestra277/		https://sineft.ru/news/	523	2022-03-21
Общие собрания акционеров в 2022 году можно проводить заочно	https://sineft.ru/news/o-provedenii-obschikh-sobraniy-aktsionerov-v-2022-/		https://sineft.ru/news/	524	2022-02-24
Начато ведение реестра владельцев ценных бумаг акционерного общества «Югорская территориальная энергетическая компания – Ханты-Мансийский район»	https://sineft.ru/news/nachato-vedenie-reestra-vladeltsev-tsennykh-bumag-275/		https://sineft.ru/news/	525	2022-02-16
АО «Индустрия-РЕЕСТР» - 24 года.	industria-reestr.ru/novosti/4383.html		https://www.industria-reestr.ru/novosti/	526	1970-01-01
Принят на обслуживание реестр акционеров АО "Красногорский бульвар"	industria-reestr.ru/novosti/4381.html		https://www.industria-reestr.ru/novosti/	527	1970-01-01
О регистрации выпуска акций АО «Красногорский бульвар»	industria-reestr.ru/novosti/4379.html		https://www.industria-reestr.ru/novosti/	528	1970-01-01
Принят на обслуживание реестр акционеров АО "Светлица"	industria-reestr.ru/novosti/4378.html		https://www.industria-reestr.ru/novosti/	529	1970-01-01
Принят на обслуживание реестр акционеров АО "СПОРТ КОНСТРАКШН"	industria-reestr.ru/novosti/4376.html		https://www.industria-reestr.ru/novosti/	530	1970-01-01
О регистрации выпуска акций АО «Светлица»	industria-reestr.ru/novosti/4375.html		https://www.industria-reestr.ru/novosti/	531	1970-01-01
Принят на обслуживание реестр акционеров АО "Содружество "Альфа"	industria-reestr.ru/novosti/4374.html		https://www.industria-reestr.ru/novosti/	532	1970-01-01
О регистрации выпуска акций АО «СПОРТ КОНСТРАКШН»	industria-reestr.ru/novosti/4377.html		https://www.industria-reestr.ru/novosti/	533	1970-01-01
АО «Индустрия-РЕЕСТР» сообщает о подаче сведений в ФНС России для формирования Единого реестра субъектов малого и среднего предпринимательства	industria-reestr.ru/novosti/4373.html		https://www.industria-reestr.ru/novosti/	534	1970-01-01
Принят на обслуживание реестр акционеров АО "Грани Города"	industria-reestr.ru/novosti/4372.html		https://www.industria-reestr.ru/novosti/	535	1970-01-01
Принят на обслуживание реестр акционеров АО "СФЕРА АКТИВ"	industria-reestr.ru/novosti/4371.html		https://www.industria-reestr.ru/novosti/	536	1970-01-01
Принят на обслуживание реестр акционеров ЗАО "СОФТПРОМ"	industria-reestr.ru/novosti/4370.html		https://www.industria-reestr.ru/novosti/	537	1970-01-01
Принят на обслуживание реестр акционеров АО "Медицинский центр Малахит-Мисхор"	industria-reestr.ru/novosti/4365.html		https://www.industria-reestr.ru/novosti/	538	1970-01-01
Принят на обслуживание реестр акционеров АО "Проектный институт "Сибирский Промтранспроект"	industria-reestr.ru/novosti/4363.html		https://www.industria-reestr.ru/novosti/	539	1970-01-01
О регистрации выпуска акций АО «Медицинский центр Малахит-Мисхор»	industria-reestr.ru/novosti/4362.html		https://www.industria-reestr.ru/novosti/	540	1970-01-01
Уведомление об изменении банковских реквизитов	industria-reestr.ru/novosti/4361.html		https://www.industria-reestr.ru/novosti/	541	1970-01-01
Принят на обслуживание реестр акционеров АО "СПЕЦИАЛИЗИРОВАННЫЙ ЗАСТРОЙЩИК "КРАСНЫЙ МАЯК"	industria-reestr.ru/novosti/4358.html		https://www.industria-reestr.ru/novosti/	545	1970-01-01
О регистрации выпуска акций АО «СПЕЦИАЛИЗИРОВАННЫЙ ЗАСТРОЙЩИК «КРАСНЫЙ МАЯК»	industria-reestr.ru/novosti/4356.html		https://www.industria-reestr.ru/novosti/	546	1970-01-01
О проведении общих собраний акционеров в 2022 г.	industria-reestr.ru/novosti/4349.html		https://www.industria-reestr.ru/novosti/	547	1970-01-01
Внимание! Новый прейскурант для зарегистрированных лиц	industria-reestr.ru/novosti/4346.html		https://www.industria-reestr.ru/novosti/	548	1970-01-01
Принят на обслуживание реестр акционеров АО "ПРОИЗВОДСТВЕННО-ПРОЕКТНАЯ АГРОСТРОИТЕЛЬНАЯ КОРПОРАЦИЯ "НЕЧЕРНОЗЕМАГРОПРОМСТРОЙ"	industria-reestr.ru/novosti/4343.html		https://www.industria-reestr.ru/novosti/	549	1970-01-01
Принят на обслуживание реестр акционеров ЗАО "Центр содействия развитию предпринимательства "ИНИЦИАТИВА"	industria-reestr.ru/novosti/4342.html		https://www.industria-reestr.ru/novosti/	550	1970-01-01
Прием на обслуживание АО "ТТЛ"	servis-reestr.ru/novosti/2863520/		https://servis-reestr.ru/novosti/	551	2022-10-25
Прием на обслуживание АО "Инвестиционная Компания Альянс Капитал"	servis-reestr.ru/novosti/2863476/		https://servis-reestr.ru/novosti/	552	2022-10-13
Прием на обслуживание АО "Компания ТехноБлок"	servis-reestr.ru/novosti/2863465/		https://servis-reestr.ru/novosti/	553	2022-10-12
Прием на обслуживание АО "Крон-групп"	servis-reestr.ru/novosti/2863464/		https://servis-reestr.ru/novosti/	554	2022-10-12
Прием на обслуживание АО "АЭЛИТА"	servis-reestr.ru/novosti/2863434/		https://servis-reestr.ru/novosti/	555	2022-10-04
Прием на обслуживание АО "Хиппо"	servis-reestr.ru/novosti/2863420/		https://servis-reestr.ru/novosti/	556	2022-09-29
Прием на обслуживание АО "ПКИ"	servis-reestr.ru/novosti/2863410/		https://servis-reestr.ru/novosti/	557	2022-09-27
Прием на обслуживание АО "ШАРД"	servis-reestr.ru/novosti/2863381/		https://servis-reestr.ru/novosti/	558	2022-09-20
Вниманию клиентов!	earc.ru/novosti/9785/		https://www.earc.ru/novosti/	559	2022-11-01
ООО «ЕАР» осуществил регистрацию выпуска акций	earc.ru/novosti/9786/		https://www.earc.ru/novosti/	560	2022-10-26
Вниманию клиентов!	earc.ru/novosti/9787/		https://www.earc.ru/novosti/	561	2022-10-17
Заключение договора на ведение реестра	earc.ru/novosti/9788/		https://www.earc.ru/novosti/	562	2022-09-26
Вниманию клиентов!	earc.ru/novosti/9789/		https://www.earc.ru/novosti/	563	2022-09-15
Вниманию клиентов!	earc.ru/novosti/9790/		https://www.earc.ru/novosti/	564	2022-08-31
Заключение договора на ведение реестра	earc.ru/novosti/9791/		https://www.earc.ru/novosti/	565	2022-08-22
Заключение договора на ведение реестра	earc.ru/novosti/9792/		https://www.earc.ru/novosti/	566	2022-08-22
Регистрация выпуска осуществлена в 2 дня!	earc.ru/novosti/9793/		https://www.earc.ru/novosti/	567	2022-08-10
ООО «ЕАР» осуществил регистрацию выпуска акций	earc.ru/novosti/9794/		https://www.earc.ru/novosti/	568	2022-08-04
Сервис «Личный кабинет Эмитента»	earc.ru/novosti/9795/		https://www.earc.ru/novosti/	569	2022-05-25
Вниманию эмитентов!	earc.ru/novosti/9796/		https://www.earc.ru/novosti/	570	2022-05-05
Изменения при подготовке ГОСА в 2022г.	earc.ru/novosti/9797/		https://www.earc.ru/novosti/	571	2022-03-10
ГОСА 2022 можно проводить в заочной форме	earc.ru/novosti/9798/		https://www.earc.ru/novosti/	572	2022-02-28
Заключение договора на ведение реестра	earc.ru/novosti/9799/		https://www.earc.ru/novosti/	573	2022-02-17
Нам 20 лет!	earc.ru/novosti/9800/		https://www.earc.ru/novosti/	574	2022-02-09
Акционерам ПАО «Нижнекамскнефтехим»	earc.ru/novosti/9801/		https://www.earc.ru/novosti/	575	2022-01-28
Акционерам ПАО «Казаньоргсинтез»	earc.ru/novosti/9802/		https://www.earc.ru/novosti/	576	2022-01-28
Внимание! Сервис «Личный кабинет Акционера»	earc.ru/novosti/9803/		https://www.earc.ru/novosti/	577	2022-01-21
С 17.01.2022 изменены часы  приема клиентов.	earc.ru/novosti/9804/		https://www.earc.ru/novosti/	578	2022-01-17
ООО «ЕАР» осуществил регистрацию выпуска акций	earc.ru/novosti/9805/		https://www.earc.ru/novosti/	579	2022-01-10
ООО «ЕАР» поздравляет с Днем энергетика!	earc.ru/novosti/9806/		https://www.earc.ru/novosti/	580	2021-12-22
Интервью генерального директора СМИ	earc.ru/novosti/9807/		https://www.earc.ru/novosti/	581	2021-12-08
ООО «ЕАР» принял участие в семинаре	earc.ru/novosti/9808/		https://www.earc.ru/novosti/	582	2021-12-02
Вниманию клиентов!	earc.ru/novosti/9809/		https://www.earc.ru/novosti/	583	2021-12-02
Вниманию клиентов!	earc.ru/novosti/9811/		https://www.earc.ru/novosti/	584	2021-11-24
Вниманию клиентов!	earc.ru/novosti/9812/		https://www.earc.ru/novosti/	585	2021-11-08
Заключение договора на ведение реестра	earc.ru/novosti/9813/		https://www.earc.ru/novosti/	586	2021-10-28
Вниманию клиентов!	earc.ru/novosti/9814/		https://www.earc.ru/novosti/	587	2021-10-27
ООО «ЕАР» осуществил регистрацию выпуска акций	earc.ru/novosti/9815/		https://www.earc.ru/novosti/	588	2021-10-13
Принят реестр владельцев ценных бумаг	https://paritet.ru/prinyat-reestr-vladelczev-czennyh-bumag-167/	Принят на обслуживание реестр владельцев ценных бумаг: Акционерное общество Группа компаний «Обонато»	https://paritet.ru/all-news/	589	2022-11-02
АО «ДРАГА» выступило партнером конференции «Корпоративное право 2022»	https://draga.ru/novosti/novosti-kompanii/strong-ao-draga-vystupilo-partnerom-konferencii-korporativnoe-pravo-2022-strong/	Регистратор «ДРАГА» выступил партнером конференции «Корпоративное право 2022», организованной журналом «Акционерное общество: вопросы корпоративного управления», прошедшей 28 октября 2022 года. В рамках...	https://draga.ru/topics/novosti/	590	2022-11-03
АО «СРК» ОСУЩЕСТВИЛО РЕГИСТРАЦИЮ ВЫПУСКА ЦЕННЫХ БУМАГ АО «АКСИОМА»	zao-srk.ru/novosti/zaregistrirovannye-vypuski-tsb/6250.html		https://zao-srk.ru/novosti/	591	1970-01-01
АО «СРК» ОСУЩЕСТВИЛО РЕГИСТРАЦИЮ ВЫПУСКА ЦЕННЫХ БУМАГ АО «ЮТЕКС»	zao-srk.ru/novosti/zaregistrirovannye-vypuski-tsb/6248.html		https://zao-srk.ru/novosti/	592	1970-01-01
Новые возможности личного кабинета клиента – «Реестр-онлайн»	aoreestr.ru/press/news/novye-vozmozhnosti-lichnogo-kabineta-klienta-reestr-onlayn/		https://aoreestr.ru/press	593	2022-11-03
АО «Новый регистратор» осуществил ежемесячную подачу сведений для реестра МСП	https://www.newreg.ru/news/ao-novyj-registrator-osushhestvil-ezhemesjachnuju-podachu-svedenij-dlja-reestra-msp/	03.11.2022\n2 ноября 2022 года АО «Новый регистратор» осуществил ежемесячную подачу сведений в ФНС России в целях ведения единого реестра субъектов малого и среднего предпринимательства в соответствии с подпунктом 7.1. части 6.5. статьи 4.1. Федерального закона от 24.07.2007 N 209-ФЗ «О развитии малого и среднего предпринимательства в Российской Федерации».	https://www.newreg.ru/news/	594	2022-11-03
Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов	rtreg.ru/posts/news-03-11-22	Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов.	https://rtreg.ru/posts	595	1970-01-01
02.11.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекратили хранить реестр: ОАО "СТАРОМИНСКАГРОПРОМСТРОЙ" ИНН 2350005680, ОГРН 1022304684159 в связи с истечением срока хранения\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1456		https://regkrc.ru/news/	596	2022-11-02
АО «Реестр» с 31 октября по 6 ноября приступило к ведению реестров следующих эмитентов	aoreestr.ru		https://aoreestr.ru/press	597	2022-11-01
Новости обслуживания	https://www.vrk.ru/news/item/598/	09.11.2022 приняты на обслуживание эмитенты АО "ЕКАТЕРИНИНСКАЯ БОЛЬНИЦА", ЗАО "СИМОКС".	https://www.vrk.ru/news	598	2022-11-10
Новости обслуживания	https://www.vrk.ru/news/item/597/	03.11.2022 принят на обслуживание эмитент АО "ИРКУТСКИЙ НАУЧНО-ИССЛЕДОВАТЕЛЬСКИЙ ИНСТИТУТ БЛАГОРОДНЫХ И РЕДКИХ МЕТАЛЛОВ И АЛМАЗОВ"	https://www.vrk.ru/news	599	2022-11-07
АО «Новый регистратор» осуществил регистрацию выпуска акций	https://www.newreg.ru/news/ao-novyj-registrator-osushhestvil-registraciju-vypuska-akcij-222/	09.11.2022\nАО «Новый регистратор» 09.11.2022 принято решение о регистрации выпуска обыкновенных акций Акционерного общества «Адвансед тех» (Российская Федерация, город Москва), размещаемых путем распределения акций среди учредителей акционерного общества. Выпуску ценных бумаг присвоен регистрационный номер 1-01-03748-G.	https://www.newreg.ru/news/	600	2022-11-09
АО «Новый регистратор» осуществил регистрацию выпуска акций	https://www.newreg.ru/news/ao-novyj-registrator-osushhestvil-registraciju-vypuska-akcij-221/	08.11.2022\nАО «Новый регистратор» 08.11.2022 принято решение о регистрации выпуска обыкновенных акций Акционерного общества «Теримус» (Российская Федерация, город Москва), размещаемых путем приобретения акций единственным учредителем акционерного общества. Выпуску ценных бумаг присвоен регистрационный номер 1-01-03708-G.	https://www.newreg.ru/news/	601	2022-11-08
Регистрация выпуска при учреждении	https://paritet.ru/registracziya-vypuska-pri-uchrezhdenii-187/	АО «РДЦ ПАРИТЕТ» 07.11.2022г. приняло решение о регистрации выпуска обыкновенных акций Акционерного общества «Автоматизированные Металлообрабатывающие […]	https://paritet.ru/all-news/	602	2022-11-07
Обновлена информация, подлежащая обязательному раскрытию, в отношении промежуточной бухгалтерской (финансовой) отчетности АО «РТ-Регистратор» за 9 месяцев 2022 г.	rtreg.ru/posts/news-08-11-22	Обновлена информация, подлежащая обязательному раскрытию, в отношении промежуточной бухгалтерской (финансовой) отчетности АО «РТ-Регистратор» за 9 месяцев 2022 г.	https://rtreg.ru/posts	603	1970-01-01
Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов	rtreg.ru/posts/news-07-11-22	Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов.	https://rtreg.ru/posts	604	1970-01-01
07.11.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tАО «КРЦ» 07.11.2022 принято решение о регистрации выпуска ценных бумаг: акций обыкновенных Акционерного общества «Санаторий Солнце» (Российская Федерация, Краснодарский край, г. Геленджик), подлежащих...\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1457		https://regkrc.ru/news/	605	2022-11-07
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Альферац»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-alferats/		https://rostatus.ru/about/news/	606	2022-11-09
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Коперник-Инвест 3»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-kopernik-invest-3/		https://rostatus.ru/about/news/	607	2022-11-09
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Коперник-Инвест 2»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-kopernik-invest-2/		https://rostatus.ru/about/news/	608	2022-11-09
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Коперник-Инвест»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-kopernik-invest/		https://rostatus.ru/about/news/	609	2022-11-09
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Асцелла»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-astsella/		https://rostatus.ru/about/news/	610	2022-11-08
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Антарес»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-antares/		https://rostatus.ru/about/news/	611	2022-11-08
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Вола»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-vola/		https://rostatus.ru/about/news/	612	2022-11-07
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Титоли»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-titoli/		https://rostatus.ru/about/news/	613	2022-11-07
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Лотта»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-lotta/		https://rostatus.ru/about/news/	614	2022-11-07
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества Лизинговая компания «Уральский Промышленный Лизинг»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-lizingovaya-kompaniya%21/		https://rostatus.ru/about/news/	615	2022-11-07
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Столичный бизнес»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-stolichnyy-biznes/		https://rostatus.ru/about/news/	616	2022-11-02
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Элитана»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-elitana/		https://rostatus.ru/about/news/	617	2022-11-02
Генеральный директор и начальник управления информационных технологий АО «ДРАГА» приняли участие в научно-практическом семинаре ПАРТАД «Через тернии к…	https://draga.ru/novosti/novosti-kompanii/generalnyj-direktor-i-nachalnik-upravlenija-informacionnyh-tehnologij/	04.11.2022-05.11.2022 состоялся организованный ПАРТАД научно-практический семинар «Через тернии к развитию: от защиты информации до метавселенной. Вопросы применения блокчейна и иных...	https://draga.ru/topics/novosti/	618	2022-11-08
Представители Регистратора «Гарант» приняли участие в ежегодном научно-практическом семинаре ПАРТАД	reggarant.ru/index.php/ru/novosti-kompanii/1119-partad-10-2022		https://www.reggarant.ru/index.php/ru/novosti-kompanii	619	1970-01-01
Обновлена информация, подлежащая обязательному раскрытию, в отношении промежуточной бухгалтерской (финансовой) отчетности АО «РТ-Регистратор» за 9 месяцев 2022 г.	rtreg.ru/posts/news-08-11-22	Обновлена информация, подлежащая обязательному раскрытию, в отношении промежуточной бухгалтерской (финансовой) отчетности АО «РТ-Регистратор» за 9 месяцев 2022 г.	https://rtreg.ru/posts	620	2022-11-08
Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов	rtreg.ru/posts/news-07-11-22	Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов.	https://rtreg.ru/posts	621	2022-11-07
Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов	rtreg.ru/posts/news-03-11-22	Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов.	https://rtreg.ru/posts	622	2022-11-03
Добавлен Расчет собственных средств на 30.09.2022 г.	rtreg.ru/posts/news-28-10-22	Добавлен Расчет собственных средств на 30.09.2022 г.	https://rtreg.ru/posts	623	2022-10-28
Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов	rtreg.ru/posts/news-24-10-22	Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов.	https://rtreg.ru/posts	624	2022-10-24
Приглашаем принять участие в тестовой эксплуатации видеоконференции «VISUM»	zao-srk.ru/novosti/novosti/6245.html		https://zao-srk.ru/novosti/	644	2022-10-26
Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов	rtreg.ru/posts/news2-18-10-22	Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов.	https://rtreg.ru/posts	625	2022-10-18
Обновлена информация, подлежащая обязательному раскрытию, в отношении перечня трансфер-агентов	rtreg.ru/posts/news-18-10-22	Обновлена информация, подлежащая обязательному раскрытию, в отношении перечня трансфер-агентов.	https://rtreg.ru/posts	626	2022-10-18
Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов	rtreg.ru/posts/news-17-10-22	Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов.	https://rtreg.ru/posts	627	2022-10-17
Обновлена информация, подлежащая обязательному раскрытию, в отношении ПЕРЕЧНЯ ЭМИТЕНТОВ ВЫПОЛНЯЮЩИХ ПО ДОГОВОРУ ФУНКЦИИ РЕГИСТРАТОРА	rtreg.ru/posts/news-11-10-22	Обновлена информация, подлежащая обязательному раскрытию, в отношении перечня эмитентов выполняющих по договору функции регистратора.	https://rtreg.ru/posts	628	2022-10-11
Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов	rtreg.ru/posts/news-07-10-22	Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов.	https://rtreg.ru/posts	629	2022-10-07
АО «Новый регистратор» осуществил регистрацию выпуска акций	https://www.newreg.ru/news/ao-novyj-registrator-osushhestvil-registraciju-vypuska-akcij-223/	10.11.2022\nАО «Новый регистратор» 10.11.2022 принято решение о регистрации выпуска обыкновенных акций Акционерного общества «Ресона» (Российская Федерация, город Москва), размещаемых путем приобретения акций единственным учредителем акционерного общества. Выпуску ценных бумаг присвоен регистрационный номер 1-01-03761-G.	https://www.newreg.ru/news/	630	2022-11-10
Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов	rtreg.ru/posts/news-09-11-22	Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов.	https://rtreg.ru/posts	631	2022-11-09
09.11.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекращен договор с: ЗАО "АТКЦ ГАЗ" ИНН 2302030904, ОГРН 1022300637094 в связи с ликвидацией общества\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1464		https://regkrc.ru/news/	632	2022-11-09
09.11.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекратили хранить реестры: ОАО "ТИМАШЕВСКАЯ АВТОКОЛОННА № 1295" ИНН 2353019264, ОГРН 1032329670867; ОАО "БЕЛМОЛОКО" ИНН 2303001663 ОГРН 1022300712158; ОАО "ДРУЖБА" ИНН 2...\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1460		https://regkrc.ru/news/	633	2022-11-09
08.11.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекращен договор с: АО "КАНОПУС ФИНАНС" ИНН 7707430410, ОГРН 1197746311223 в связи с ликвидацией общества\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1462		https://regkrc.ru/news/	634	2022-11-08
04.11.2022\n\t\t\t\t\t\t\t\t\t\t\t \n\t\t\t\t\t\t\t\t\t\tпрекратили хранить реестр: АО "Севастопольский Стройпроект" ИНН 9201008415, ОГРН 1149204024892 в связи с истечением срока хранения\t\t\n\n   ПОДРОБНЕЕ	regkrc.ru/news/?ELEMENT_ID=1463		https://regkrc.ru/news/	635	2022-11-04
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «СЕГМЕНТ»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-segment/		https://rostatus.ru/about/news/	636	2022-11-10
Прием на обслуживание АО "М-Технолоджи"	servis-reestr.ru/novosti/2863577/		https://servis-reestr.ru/novosti/	637	2022-11-10
Новости: "Новые правила для компаний из сферы энергетики, нефтепереработки, производства оборудования сервисных услуг для ТЭК"	profrc.ru/company/news/2417		https://profrc.ru/company/news/news-our/year/2022/	638	2022-11-09
Принят реестр владельцев ценных бумаг	https://paritet.ru/prinyat-reestr-vladelczev-czennyh-bumag-168/	Принят на обслуживание реестр владельцев ценных бумаг: Акционерное общество «Специализированный застройщик «Кутузовский 16»	https://paritet.ru/all-news/	639	2022-11-10
Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов	rtreg.ru/posts/news2-11-11-22	Обновлена информация, подлежащая обязательному раскрытию, в отношении перечней реестров эмитентов.	https://rtreg.ru/posts	640	2022-11-11
Информируем Вас о смене телефона в Бийском филиале АО «РТ-Регистратор»	rtreg.ru/posts/news-11-11-22	Уважаемые акционеры и представители эмитентов!\nИнформируем Вас о смене телефона в Бийском филиале АО «РТ-Регистратор» на +7 (3854) 30-28-05 с 09 11 2022 г.	https://rtreg.ru/posts	641	2022-11-11
АО «СРК» ОСУЩЕСТВИЛО РЕГИСТРАЦИЮ ВЫПУСКА ЦЕННЫХ БУМАГ АО «АКСИОМА»	zao-srk.ru/novosti/zaregistrirovannye-vypuski-tsb/6250.html		https://zao-srk.ru/novosti/	642	2022-11-03
АО «СРК» ОСУЩЕСТВИЛО РЕГИСТРАЦИЮ ВЫПУСКА ЦЕННЫХ БУМАГ АО «ЮТЕКС»	zao-srk.ru/novosti/zaregistrirovannye-vypuski-tsb/6248.html		https://zao-srk.ru/novosti/	643	2022-11-03
Принят новый эмитент открытое акционерное общество  «Алтайавтотрансобслуживание»	zao-srk.ru/novosti/vedenie-reestrov/6244.html		https://zao-srk.ru/novosti/	645	2022-10-25
Принят новый эмитент акционерное общество «КОНСТАНТА КАПИТАЛ»	zao-srk.ru/novosti/vedenie-reestrov/6243.html		https://zao-srk.ru/novosti/	646	2022-10-24
Возобновлено ведение реестра Акционерное общество «ТЕНРОСИБ»	zao-srk.ru/novosti/vedenie-reestrov/6228.html		https://zao-srk.ru/novosti/	647	2022-10-07
Принят новый эмитент акционерное общество  «Новосибирский нефтехимический комплекс»	zao-srk.ru/novosti/vedenie-reestrov/6222.html		https://zao-srk.ru/novosti/	648	2022-10-03
АО «СРК» ОСУЩЕСТВИЛО РЕГИСТРАЦИЮ ВЫПУСКА ЦЕННЫХ БУМАГ АО «ННХК»	zao-srk.ru/novosti/zaregistrirovannye-vypuski-tsb/6206.html		https://zao-srk.ru/novosti/	649	2022-09-28
Принят новый эмитент акционерное общество  «Запсибвтормет»	zao-srk.ru/novosti/vedenie-reestrov/6195.html		https://zao-srk.ru/novosti/	650	2022-09-08
Принят новый эмитент акционерное общество  «Альтернатива»	zao-srk.ru/novosti/vedenie-reestrov/6188.html		https://zao-srk.ru/novosti/	651	2022-08-30
Принят новый эмитент закрытое акционерное общество "ГРИС"	zao-srk.ru/novosti/vedenie-reestrov/6177.html		https://zao-srk.ru/novosti/	652	2022-08-11
Штормы интеллектуальных морей	zao-srk.ru/novosti/novosti/6176.html		https://zao-srk.ru/novosti/	653	2022-08-09
АО «Индустрия-РЕЕСТР» - 24 года.	industria-reestr.ru/novosti/4383.html		https://www.industria-reestr.ru/novosti/	654	2022-10-02
Принят на обслуживание реестр акционеров АО "Красногорский бульвар"	industria-reestr.ru/novosti/4381.html		https://www.industria-reestr.ru/novosti/	655	2022-09-16
О регистрации выпуска акций АО «Красногорский бульвар»	industria-reestr.ru/novosti/4379.html		https://www.industria-reestr.ru/novosti/	656	2022-09-01
Принят на обслуживание реестр акционеров АО "Светлица"	industria-reestr.ru/novosti/4378.html		https://www.industria-reestr.ru/novosti/	657	2022-08-16
Принят на обслуживание реестр акционеров АО "СПОРТ КОНСТРАКШН"	industria-reestr.ru/novosti/4376.html		https://www.industria-reestr.ru/novosti/	658	2022-08-10
О регистрации выпуска акций АО «Светлица»	industria-reestr.ru/novosti/4375.html		https://www.industria-reestr.ru/novosti/	659	2022-08-09
Принят на обслуживание реестр акционеров АО "Содружество "Альфа"	industria-reestr.ru/novosti/4374.html		https://www.industria-reestr.ru/novosti/	660	2022-08-08
О регистрации выпуска акций АО «СПОРТ КОНСТРАКШН»	industria-reestr.ru/novosti/4377.html		https://www.industria-reestr.ru/novosti/	661	2022-08-04
АО «Индустрия-РЕЕСТР» сообщает о подаче сведений в ФНС России для формирования Единого реестра субъектов малого и среднего предпринимательства	industria-reestr.ru/novosti/4373.html		https://www.industria-reestr.ru/novosti/	662	2022-07-06
Принят на обслуживание реестр акционеров АО "Грани Города"	industria-reestr.ru/novosti/4372.html		https://www.industria-reestr.ru/novosti/	663	2022-06-20
Принят на обслуживание реестр акционеров АО "СФЕРА АКТИВ"	industria-reestr.ru/novosti/4371.html		https://www.industria-reestr.ru/novosti/	664	2022-06-16
Принят на обслуживание реестр акционеров ЗАО "СОФТПРОМ"	industria-reestr.ru/novosti/4370.html		https://www.industria-reestr.ru/novosti/	665	2022-05-11
Принят на обслуживание реестр акционеров АО "Медицинский центр Малахит-Мисхор"	industria-reestr.ru/novosti/4365.html		https://www.industria-reestr.ru/novosti/	666	2022-04-29
Принят на обслуживание реестр акционеров АО "Проектный институт "Сибирский Промтранспроект"	industria-reestr.ru/novosti/4363.html		https://www.industria-reestr.ru/novosti/	667	2022-04-20
О регистрации выпуска акций АО «Медицинский центр Малахит-Мисхор»	industria-reestr.ru/novosti/4362.html		https://www.industria-reestr.ru/novosti/	668	2022-04-19
Уведомление об изменении банковских реквизитов	industria-reestr.ru/novosti/4361.html		https://www.industria-reestr.ru/novosti/	669	2022-04-19
Принят на обслуживание реестр акционеров ОАО "Автодормехбаза" Юго-Восточного административного округа города Москвы	industria-reestr.ru/novosti/4360.html		https://www.industria-reestr.ru/novosti/	670	2022-04-14
Принят на обслуживание реестр акционеров ЗАО "Дворец на Английской"	industria-reestr.ru/novosti/4359.html		https://www.industria-reestr.ru/novosti/	671	2022-04-13
Принят на обслуживание реестр акционеров АО "Союзцветметавтоматика"	industria-reestr.ru/novosti/4357.html		https://www.industria-reestr.ru/novosti/	672	2022-04-04
Принят на обслуживание реестр акционеров АО "СПЕЦИАЛИЗИРОВАННЫЙ ЗАСТРОЙЩИК "КРАСНЫЙ МАЯК"	industria-reestr.ru/novosti/4358.html		https://www.industria-reestr.ru/novosti/	673	2022-03-31
О регистрации выпуска акций АО «СПЕЦИАЛИЗИРОВАННЫЙ ЗАСТРОЙЩИК «КРАСНЫЙ МАЯК»	industria-reestr.ru/novosti/4356.html		https://www.industria-reestr.ru/novosti/	674	2022-03-22
О проведении общих собраний акционеров в 2022 г.	industria-reestr.ru/novosti/4349.html		https://www.industria-reestr.ru/novosti/	675	2022-02-28
Внимание! Новый прейскурант для зарегистрированных лиц	industria-reestr.ru/novosti/4346.html		https://www.industria-reestr.ru/novosti/	676	2022-02-22
Принят на обслуживание реестр акционеров АО "ПРОИЗВОДСТВЕННО-ПРОЕКТНАЯ АГРОСТРОИТЕЛЬНАЯ КОРПОРАЦИЯ "НЕЧЕРНОЗЕМАГРОПРОМСТРОЙ"	industria-reestr.ru/novosti/4343.html		https://www.industria-reestr.ru/novosti/	677	2022-01-26
Принят на обслуживание реестр акционеров ЗАО "Центр содействия развитию предпринимательства "ИНИЦИАТИВА"	industria-reestr.ru/novosti/4342.html		https://www.industria-reestr.ru/novosti/	678	2022-01-26
О начале ведения реестра АО «Квинта»	crc-reg.com/info/prinyat-ao-kvinta.html	03 октября 2022 года ООО «КРК» приступило к ведению реестра владельцев ценных бумаг АО «Квинта».	https://crc-reg.com/info/	679	2022-10-03
О начале ведения реестра АО «РУСАЛ Менеджмент»	crc-reg.com/info/prinyat-ao-rusal-management.html	01 апреля 2022 года ООО «КРК» приступило к ведению реестра владельцев ценных бумаг АО «РУСАЛ Менеджмент».	https://crc-reg.com/info/	680	2022-04-01
Об изменении Формы для выявления сведений в рамках требования Указа Президента Российской Федерации от 01.03.2022 № 81	crc-reg.com/info/ob-izmenenii-formi-viyavlenie-svedeniy-81.html	Об изменении Формы для выявления сведений в рамках требования Указа Президента Российской Федерации от 01.03.2022 № 81 «О дополнительных временных мерах экономического характера по обеспечению финансовой стабильности Российской Федерации» при проведении операций с ценными бумагами клиентов».	https://crc-reg.com/info/	681	2022-03-29
О выявлении сведений в соответствии с требованиями Указа Президента Российской Федерации от 01.03.2022 № 81	crc-reg.com/info/viyavleniye-svedeniy-81-ot-01-03-2022.html	О выявлении сведений в соответствии с требованиями Указа Президента Российской Федерации от 01.03.2022 № 81 «О дополнительных временных мерах экономического характера по обеспечению финансовой стабильности Российской Федерации» при проведении операций с ценными бумагами.	https://crc-reg.com/info/	682	2022-03-10
С Новым годом!	crc-reg.com/info/happy-ny-2022.html		https://crc-reg.com/info/	683	2022-12-30
О начале ведения реестра АО «Коми Алюминий»	crc-reg.com/info/prinyat-ao-komi-alyuminiy.html	25 августа 2021 года ООО «КРК» приступило к ведению реестра владельцев ценных бумаг АО «Коми Алюминий».	https://crc-reg.com/info/	684	2022-08-25
О начале ведения реестра АО «Боксит Тимана»	crc-reg.com/info/prinyat-ao-boksit-timana.html	20 августа 2021 года ООО «КРК» приступило к ведению реестра владельцев ценных бумаг АО «Боксит Тимана».	https://crc-reg.com/info/	685	2022-08-20
АО «Новый регистратор» осуществил регистрацию выпуска акций	https://www.newreg.ru/news/ao-novyj-registrator-osushhestvil-registraciju-vypuska-akcij-224/	11.11.2022\nАО «Новый регистратор» 11.11.2022 принято решение о регистрации выпуска обыкновенных акций Акционерного общества «МатчБол» (Российская Федерация, Московская область, городской округ Истра, деревня Обушково), размещаемых путем приобретения акций единственным учредителем акционерного общества. Выпуску ценных бумаг присвоен регистрационный номер...	https://www.newreg.ru/news/	686	2022-11-11
Информация о режиме работы Пермского филиала в ноябре 2022 года	rostatus.ru/about/news/informatsiya-o-rezhime-raboty-permskogo-filiala-v-noyabre-2022-goda/		https://rostatus.ru/about/news/	687	2022-11-14
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Норокса»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-noroksa/		https://rostatus.ru/about/news/	688	2022-11-11
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Фалькон»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-falkon/		https://rostatus.ru/about/news/	689	2022-11-11
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Бамбуча»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-bambucha/		https://rostatus.ru/about/news/	690	2022-11-11
АО «СТАТУС» осуществило регистрацию выпуска акций акционерного общества «Акрукс»	rostatus.ru/about/news/ao-status-osushchestvilo-registratsiyu-vypuska-aktsiy-aktsionernogo-obshchestva-akruks/		https://rostatus.ru/about/news/	691	2022-11-11
Информация о режиме работы Находкинского филиала в ноябре 2022 года	rostatus.ru/about/news/informatsiya-o-rezhime-raboty-nakhodkinskogo-filiala-v-noyabre-2022-goda/		https://rostatus.ru/about/news/	692	2022-11-11
Вниманию акционеров ОАО «Запсибгазпром».	https://draga.ru/novosti/message-issuers/vnimaniju-akcionerov-strong-oao-zapsibgazprom-strong/	Информация по процедуре выкупа акций эмитентом: Памятка акционерам;Рекомендуемая форма требования о выкупе акций ОА;Рекомендуемая форма требования о выкупе акций ПА;Рекомендуемая...	https://draga.ru/topics/novosti/	693	2022-11-14
\.


--
-- Data for Name: news_test; Type: TABLE DATA; Schema: public; Owner: izvekov
--

COPY public.news_test (title, link, description, site_link, id, "time") FROM stdin;
Возобновлено ведение реестра ЗАО "АгроЦентр" (г. Грайворон Белгородская обл.)	registrator-rekom.ru/news/agrocentr/		http://registrator-rekom.ru/news/	3740	2022-08-24
в период с 1 по 7 ноября является не рабочими днями ООО СР "РЕКОМ"	registrator-rekom.ru/news//		http://registrator-rekom.ru/news/	3741	2021-10-28
Принят на обслуживание реестр АО "ДИЛЕКСИМА" (г. Москва)	registrator-rekom.ru/news/DILEKS/		http://registrator-rekom.ru/news/	3742	2021-10-25
Смена места нахождения Белгородского филиала №2	registrator-rekom.ru/news/BelgorodHome/		http://registrator-rekom.ru/news/	3743	2021-08-25
Принят на обслуживание реестр АО "Богданка 111" (г. Белгород)	registrator-rekom.ru/news/Bogdanka/		http://registrator-rekom.ru/news/	3744	2021-04-21
Белгородским филиалом №2 завершена регистрация АО "Богданка 111" в ЕГРЮЛ	registrator-rekom.ru/news/BogdankaEDO/		http://registrator-rekom.ru/news/	3745	2021-04-16
Зарегистрирован выпуск ЦБ при учреждении АО "Богданка 111" (г. Белгород)	registrator-rekom.ru/news/Bogdanka/		http://registrator-rekom.ru/news/	3746	2021-04-12
c 22.03.2021 г. вступает в силу новый прейскурант услуг регистратора ООО СР "Реком" для всех филиалов	registrator-rekom.ru/news//		http://registrator-rekom.ru/news/	3747	2021-03-16
Принят на обслуживание реестр ОАО "Алексеевский райтопсбыт" (г. Алексеевка, Белгородская обл.)	registrator-rekom.ru/news/RTS/		http://registrator-rekom.ru/news/	3748	2021-02-26
Принят на обслуживание реестр АО "Инвест Плюс" (г. Москва)	registrator-rekom.ru/news/InvestPlus/		http://registrator-rekom.ru/news/	3749	2020-11-25
Зарегистрирован выпуск ЦБ при учреждении АО "Инвест Плюс" (г. Москва)	registrator-rekom.ru/news/InvestPlus/		http://registrator-rekom.ru/news/	3750	2020-11-16
Принят на обслуживание реестр АО "БелТрансСервис" (г. Белгород)	registrator-rekom.ru/news/BelTransServis/		http://registrator-rekom.ru/news/	3751	2020-11-09
Принят на обслуживание реестр ОАО "Управление механизации №3" (г. Белгород)	registrator-rekom.ru/news//		http://registrator-rekom.ru/news/	3752	2020-09-07
О работе офисов регистратора в период с 01.05.2020 г. по 12.05.2020 г.	registrator-rekom.ru/news/WokrOfice /		http://registrator-rekom.ru/news/	3753	2020-04-30
О работе офисов регистратора в период с 04.04.2020 г. по 30.04.2020 г.	registrator-rekom.ru/news/WokrOfice/		http://registrator-rekom.ru/news/	3754	2020-04-06
О работе  ООО СР "Реком" в период с 30 марта 2020 года по 05 апреля 2020 года	registrator-rekom.ru/news/coronvir/		http://registrator-rekom.ru/news/	3755	2020-03-27
Принят на обслуживание реестр АО "ПАНОРАМА" (г. Барнаул, Алтайский край)	registrator-rekom.ru/news/panorama/		http://registrator-rekom.ru/news/	3756	2019-07-22
Принят на обслуживание реестр АО "АВАЛОН" (г. Барнаул, Алтайский край)	registrator-rekom.ru/news/avalon/		http://registrator-rekom.ru/news/	3757	2019-07-22
Прекращено ведение реестра ЗАО "Мебель" (Белгородская область, г. Старый Оскол)	registrator-rekom.ru/news/mebel#stosk/		http://registrator-rekom.ru/news/	3758	2019-07-19
Прекращено ведение реестра ЗАО "Алтайкровля" (Алтайский край, г. Новоалтайск) с 15.07.2019 г.	registrator-rekom.ru/news/altajkrovlya/		http://registrator-rekom.ru/news/	3759	2019-07-15
Принят на обслуживание реестр АО "СЕВАЛ" (г. Кандалакша, Мурманская обл.)	registrator-rekom.ru/news/seval/		http://registrator-rekom.ru/news/	3760	2019-04-12
Принят на обслуживание реестр ЗАО "БЕЛКАР" (г. Белгород)	registrator-rekom.ru/news/BELKAR/		http://registrator-rekom.ru/news/	3761	2019-03-21
Принят на обслуживание реестр АО "НОРДВАЙЕР" (г. Мурманск)	registrator-rekom.ru/news/NORDV/		http://registrator-rekom.ru/news/	3762	2018-12-24
Закрытие филиала	registrator-rekom.ru/news/rekom/		http://registrator-rekom.ru/news/	3763	2017-12-29
Принят на обслуживание реестр АО "РУС-Индустрия" (Белгородская область, Белгородский район)	registrator-rekom.ru/news/industri/		http://registrator-rekom.ru/news/	3764	2017-12-26
Принят на обслуживание реестр ЗАО "ТАБЗ" (г. Белгород)	registrator-rekom.ru/news/tabs/		http://registrator-rekom.ru/news/	3765	2017-04-18
Принят на обслуживание реестр ЗАО "ТриО" (Белгородская обл., Грайворонский р-н)	registrator-rekom.ru/news/trio/		http://registrator-rekom.ru/news/	3766	2016-07-25
Принят на обслуживание реестр АО "Белмашэнерго" (г. Белгород)	registrator-rekom.ru/news/belmashe/		http://registrator-rekom.ru/news/	3767	2016-06-03
Принят на обслуживание реестр ЗАО "Энергокотломонтаж" (г. Белгород)	registrator-rekom.ru/news/ekm/		http://registrator-rekom.ru/news/	3768	2016-05-11
Принят на обслуживание реестр ОАО "Белгородрыбхоз" (г. Белгород)	registrator-rekom.ru/news/belrybhoz/		http://registrator-rekom.ru/news/	3769	2016-03-29
Размещены на сайте новые бланки Анкет	registrator-rekom.ru/news/anketa/		http://registrator-rekom.ru/news/	3770	2016-01-10
Принят на обслуживание реестр ОАО "Ольгард" (г. Белгород)	registrator-rekom.ru/news/olgard/		http://registrator-rekom.ru/news/	3771	2015-12-30
Принят на обслуживание реестр ЗАО "Заготпромсервис" (г. Белгород)	registrator-rekom.ru/news/zagpromserv/		http://registrator-rekom.ru/news/	3772	2015-12-18
Принят на обслуживание реестр ЗАО "Стройиндустрия" (г. Белгород)	registrator-rekom.ru/news/stroyind/		http://registrator-rekom.ru/news/	3773	2015-12-16
Принят на обслуживание реестр ЗАО "ФОРМАСТЕР" (г. Белгород)	registrator-rekom.ru/news/FORMASTER/		http://registrator-rekom.ru/news/	3774	2015-11-24
Принят на обслуживание реестр ЗАО "НПК Ветеран-БАЛС" (г. Белгород)	registrator-rekom.ru/news/BALS/		http://registrator-rekom.ru/news/	3775	2015-11-20
Принят на обслуживание реестр АО "Цветлит" (г. Саранск)	registrator-rekom.ru/news/cvetlit/		http://registrator-rekom.ru/news/	3776	2015-09-28
Принят на обслуживание реестр ЗАО "МЕГАТОНН" (г. Белгород)	registrator-rekom.ru/news/megatonn/		http://registrator-rekom.ru/news/	3777	2015-07-20
Принят на обслуживание реестр ЗАО "Энерготехпром" (г. Курчатов, Курская область)	registrator-rekom.ru/news/energoprom/		http://registrator-rekom.ru/news/	3778	2015-07-15
Принят на обслуживание реестр ОАО БПМК "Росхлебстроймонтаж" (г. Белгород)	registrator-rekom.ru/news/bpmk_ros/		http://registrator-rekom.ru/news/	3779	2015-06-30
С 21.05.2015 г. вступает в силу новый прейскурант услуг регистратора ООО СР "Реком" Московский филиал	registrator-rekom.ru/news/prmf/		http://registrator-rekom.ru/news/	3780	2015-05-14
Принят на обслуживание реестр ЗАО "Инэлектро" (г. Курчатов, Курская область)	registrator-rekom.ru/news/inlektro/		http://registrator-rekom.ru/news/	3781	2015-05-08
Принят на обслуживание реестр АО "СтандартЦемент" (г. Белгород)	registrator-rekom.ru/news/stcem/		http://registrator-rekom.ru/news/	3782	2015-04-01
Изменение банковских реквизитов Белгородского филиала	registrator-rekom.ru/news/chbank/		http://registrator-rekom.ru/news/	3783	2015-04-01
Принят на обслуживание реестр ОАО "БЕЛЭЛЕКТРОКАБЕЛЬ" (г. Белгород)	registrator-rekom.ru/news/belelkab/		http://registrator-rekom.ru/news/	3784	2015-03-05
Изменение телефонных номеров	registrator-rekom.ru/news/chtelephon/		http://registrator-rekom.ru/news/	3785	2015-02-19
Добро пожаловать на новую версию сайта СР "Реком"	registrator-rekom.ru/news/newsite/		http://registrator-rekom.ru/news/	3786	2014-11-01
\.


--
-- Name: news_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.news_id_seq', 693, true);


--
-- Name: news_test_id_seq; Type: SEQUENCE SET; Schema: public; Owner: izvekov
--

SELECT pg_catalog.setval('public.news_test_id_seq', 3786, true);


--
-- Name: news_test news_pkey; Type: CONSTRAINT; Schema: public; Owner: izvekov
--

ALTER TABLE ONLY public.news_test
    ADD CONSTRAINT news_pkey PRIMARY KEY (id);


--
-- Name: news news_pkey1; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.news
    ADD CONSTRAINT news_pkey1 PRIMARY KEY (id);


--
-- Name: news news_title_link_time_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.news
    ADD CONSTRAINT news_title_link_time_key UNIQUE (title, link, "time");


--
-- Name: news_test uni; Type: CONSTRAINT; Schema: public; Owner: izvekov
--

ALTER TABLE ONLY public.news_test
    ADD CONSTRAINT uni UNIQUE (title, link, "time");


--
-- Name: TABLE news; Type: ACL; Schema: public; Owner: postgres
--

GRANT ALL ON TABLE public.news TO parser_user;


--
-- Name: SEQUENCE news_id_seq; Type: ACL; Schema: public; Owner: postgres
--

GRANT ALL ON SEQUENCE public.news_id_seq TO parser_user;


--
-- Name: TABLE news_test; Type: ACL; Schema: public; Owner: izvekov
--

GRANT ALL ON TABLE public.news_test TO parser_user;


--
-- Name: SEQUENCE news_test_id_seq; Type: ACL; Schema: public; Owner: izvekov
--

GRANT ALL ON SEQUENCE public.news_test_id_seq TO parser_user;


--
-- PostgreSQL database dump complete
--

