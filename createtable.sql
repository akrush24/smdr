DROP TABLE IF EXISTS `smdr`;

#TEST#

CREATE TABLE `smdr` (
  `CallStart` varchar(250) CHARACTER SET utf8 NOT NULL,
  `ConnectedTime` varchar(250) CHARACTER SET utf8 NOT NULL,
  `RingTime` text CHARACTER SET utf8 NOT NULL,
  `Caller` text CHARACTER SET utf8 NOT NULL,
  `Direction` text CHARACTER SET utf8 NOT NULL,
  `CalledNumber` text CHARACTER SET utf8 NOT NULL,
  `DialledNumber` text CHARACTER SET utf8 NOT NULL,
  `Account` text CHARACTER SET utf8 NOT NULL,
  `IsInternal` text CHARACTER SET utf8 NOT NULL,
  `CallID` text CHARACTER SET utf8 NOT NULL,
  `Continuation` text CHARACTER SET utf8 NOT NULL,
  `Party1Device` text CHARACTER SET utf8 NOT NULL,
  `Party1Name` text CHARACTER SET utf8 NOT NULL,
  `Party2Device` text CHARACTER SET utf8 NOT NULL,
  `Party2Name` text CHARACTER SET utf8 NOT NULL,
  `HoldTime` text CHARACTER SET utf8 NOT NULL,
  `ParkTime` text CHARACTER SET utf8 NOT NULL,
  `AuthValid` text CHARACTER SET utf8 NOT NULL,
  `AuthCode` text CHARACTER SET utf8 NOT NULL,
  `UserCharged` text CHARACTER SET utf8 NOT NULL,
  `CallCharge` text CHARACTER SET utf8 NOT NULL,
  `Currency` text CHARACTER SET utf8 NOT NULL,
  `AmountatLastUserChange` text CHARACTER SET utf8 NOT NULL,
  `CallUnits` text CHARACTER SET utf8 NOT NULL,
  `UnitsatLastUserChange` text CHARACTER SET utf8 NOT NULL,
  `CostperUnit` text CHARACTER SET utf8 NOT NULL,
  `MarkUp` text CHARACTER SET utf8 NOT NULL,
  `ExternalTargetingCause` text CHARACTER SET utf8 NOT NULL,
  `ExternalTargeterId` text CHARACTER SET utf8 NOT NULL,
  `ExternalTargetedNumber` text CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM CHARACTER SET=utf8



#####
END OF FILE
