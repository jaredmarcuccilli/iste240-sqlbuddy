function setup() {
    let lesson = '\
create table Users ( UserID int, Username varchar(255), FirstName varchar(255), LastName varchar(255), State varchar(255), );\
insert into Users \
    ( UserID, Username, FirstName, LastName, State) VALUES \
    (1, sr5667, "Sean","Richards", "Iowa" ),\
    (2, th7826, "Tai", "Hartman", "New York");\
    ';

    let tokenStream = new Parser(lesson);
    program.run(tokenStream);
    program.execute();
}